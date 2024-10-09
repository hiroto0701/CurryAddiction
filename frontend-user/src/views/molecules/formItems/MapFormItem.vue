<script setup lang="ts">
import { ref, onMounted } from 'vue';
import type { Component } from 'vue';
import FormLayout from '@/views/templates/FormLayout.vue';

interface Props {
  readonly label: string;
  readonly required: boolean;
  readonly iconComponent: Component;
}
defineProps<Props>();

const mapContainer = ref<HTMLElement | null>(null);
const map = ref<google.maps.Map | null>(null);
const searchBox = ref<google.maps.places.SearchBox | null>(null);

function initMap(position?: GeolocationPosition) {
  if (mapContainer.value) {
    const defaultPosition = { lat: 35.6812, lng: 139.7671 }; // 東京駅をデフォルト位置にする
    const center = position
      ? { lat: position.coords.latitude, lng: position.coords.longitude }
      : defaultPosition;

    // 地図の初期化
    map.value = new google.maps.Map(mapContainer.value, {
      center: center,
      zoom: 15
    });

    // 検索ボックス初期化
    const input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('placeholder', '場所を検索');
    map.value.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

    searchBox.value = new google.maps.places.SearchBox(input);

    // 検索結果にバイアスをかける
    map.value.addListener('bounds_changed', () => {
      searchBox.value?.setBounds(map.value?.getBounds() as google.maps.LatLngBounds);
    });

    searchBox.value.addListener('places_changed', () => {
      const places = searchBox.value?.getPlaces();
      if (places?.length === 0) {
        return;
      }

      const bounds = new google.maps.LatLngBounds();
      places?.forEach((place) => {
        if (!place.geometry || !place.geometry.location) {
          console.log('Returned place contains no geometry');
          return;
        }

        // ピンの作成
        new google.maps.Marker({
          map: map.value,
          title: place.name,
          position: place.geometry.location
        });

        if (place.geometry.viewport) {
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.value?.fitBounds(bounds);
    });
  }
}

onMounted(() => {
  if ('geolocation' in navigator) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        initMap(position);
      },
      (error) => {
        console.error('Error getting current location:', error);
        initMap();
      },
      { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 }
    );
  } else {
    console.log('Geolocation is not supported by this browser.');
    initMap();
  }
});
</script>
<template>
  <FormLayout :label="label" :required="required" :iconComponent="iconComponent">
    <div ref="mapContainer" style="width: 100%; height: 400px"></div>
  </FormLayout>
</template>
