<script setup lang="ts">
/// <reference types="google.maps" />
import { Loader } from '@googlemaps/js-api-loader';
import { ref, onMounted } from 'vue';

const mapContainer = ref<HTMLElement | null>(null);
const searchBox = ref<google.maps.places.SearchBox | null>(null);
let map: google.maps.Map;
let markers: google.maps.marker.AdvancedMarkerElement[] = [];
let infoWindow: google.maps.InfoWindow | null = null;

const loader = new Loader({
  apiKey: import.meta.env.VITE_GOOGLE_MAP_API_KEY_DEV,
  version: 'weekly',
  libraries: ['places', 'marker'],
  region: 'JP',
  language: 'ja'
});

async function initMap(position?: GeolocationPosition) {
  if (!mapContainer.value) return;

  try {
    await loader.importLibrary('maps');
    await loader.importLibrary('marker');
    await loader.importLibrary('places');

    const { Map } = (await google.maps.importLibrary('maps')) as google.maps.MapsLibrary;
    const { AdvancedMarkerElement } = (await google.maps.importLibrary(
      'marker'
    )) as google.maps.MarkerLibrary;

    const defaultPosition = { lat: 35.6812, lng: 139.7671 }; // 東京駅をデフォルト位置にする
    const center = position
      ? { lat: position.coords.latitude, lng: position.coords.longitude }
      : defaultPosition;

    // 地図の初期化
    const mapOptions = {
      center,
      zoom: 15,
      mapTypeControl: true,
      mapId: 'DEMO_MAP_ID'
    };

    map = new Map(mapContainer.value, mapOptions);

    // InfoWindow の初期化
    infoWindow = new google.maps.InfoWindow();

    // SearchBox初期化
    const input = document.getElementById('pac-input') as HTMLInputElement;
    searchBox.value = new google.maps.places.SearchBox(input);

    // SearchBoxの結果が変更されたときのイベント
    searchBox.value.addListener('places_changed', () => {
      const places = searchBox.value?.getPlaces();

      if (!places || places.length === 0) {
        return;
      }

      // 古いマーカーをクリア
      markers.forEach((marker) => {
        marker.map = null;
      });
      markers = [];

      const bounds = new google.maps.LatLngBounds();

      places.forEach((place) => {
        if (!place.geometry || !place.geometry.location) {
          console.log('Returned place contains no geometry');
          return;
        }

        // 各場所にAdvancedMarkerElementを作成
        const marker = new AdvancedMarkerElement({
          map,
          position: place.geometry.location,
          title: place.name
        });

        markers.push(marker);

        // InfoWindow のコンテンツを作成
        const googleMapsLink = `https://www.google.com/maps?q=${place.name}${place.formatted_address}`;
        const content = `
        <div>
          <h3 class="text-base font-medium">${place.name}</h3>
          <p>${place.formatted_address || ''}</p>
          <a href="${googleMapsLink}" class="text-blue-600 md:hover:underline" target="_blank" rel="noopener noreferrer">GoogleMapで見る</a>
        </div>
      `;

        // マーカーにクリックイベントを追加
        marker.addListener('click', () => {
          infoWindow?.setContent(content);
          infoWindow?.open(map, marker);
        });

        // 検索結果が1件のみの場合、InfoWindowを自動的に表示
        if (places.length === 1) {
          infoWindow?.setContent(content);
          infoWindow?.open(map, marker);
        }

        if (place.geometry.viewport) {
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });

      map?.fitBounds(bounds);
    });
  } catch (error) {
    console.error('Error initializing Google Maps:', error);
  }
}

onMounted(async () => {
  if ('geolocation' in navigator) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        initMap(position);
      },
      (error) => {
        console.error('Error getting current location:', error);
        initMap();
      },
      { enableHighAccuracy: true, timeout: 3000, maximumAge: 0 }
    );
  } else {
    console.log('Geolocation is not supported by this browser.');
    initMap();
  }
});
</script>
<template>
  <h1 class="font-body text-2xl font-medium">店舗検索</h1>
  <input
    type="text"
    class="mt-3 w-full rounded border border-gray-200 p-2 pr-9 font-body"
    id="pac-input"
    placeholder="場所を検索"
  />
  <div class="relative">
    <div ref="mapContainer" class="mt-5" style="width: 100%; height: 600px"></div>
  </div>
</template>
