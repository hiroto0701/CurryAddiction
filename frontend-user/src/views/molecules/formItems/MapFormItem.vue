<script setup lang="ts">
/// <reference types="google.maps" />
import { Loader } from '@googlemaps/js-api-loader';
import { ref, onMounted } from 'vue';
import type { Component } from 'vue';
import FormLayout from '@/views/templates/FormLayout.vue';
import FormErrorMessage from '@/views/atoms/ErrorMessage/FormErrorMessage.vue';

interface AddressComponent {
  long_name: string;
  short_name: string;
  types: string[];
}

interface StructuredAddress {
  postcode: string;
  prefecture: string;
  municipality: string;
  ward?: string;
  district: string;
}

interface Props {
  readonly label: string;
  readonly required: boolean;
  readonly iconComponent: Component;
  readonly placeholder?: string;
  readonly errors?: Record<string, string[]>;
}
defineProps<Props>();

const emits = defineEmits<{
  (e: 'update:location', location: { lat: number; lng: number }): void;
  (
    e: 'update:locationInfo',
    official_name: string,
    formatted_address: string,
    structuredAddress: StructuredAddress
  ): void;
}>();

const mapContainer = ref<HTMLElement | null>(null);
const autocomplete = ref<google.maps.places.Autocomplete | null>(null);
let map: google.maps.Map;
let marker: google.maps.marker.AdvancedMarkerElement | null = null;
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

    const defaultPosition = { lat: 35.6812, lng: 139.7671 }; // 東京駅をデフォルト位置にする
    const center = position
      ? { lat: position.coords.latitude, lng: position.coords.longitude }
      : defaultPosition;

    // 地図の初期化
    const mapOptions: google.maps.MapOptions = {
      center,
      zoom: 15,
      mapTypeControl: true,
      mapId: 'DEMO_MAP_ID'
    };

    map = new google.maps.Map(mapContainer.value, mapOptions);

    // マーカーの初期化
    marker = new google.maps.marker.AdvancedMarkerElement({
      map,
      position: null
    });

    // AutoComplete初期化
    const input = document.getElementById('pac-input') as HTMLInputElement;
    const options: google.maps.places.AutocompleteOptions = {
      fields: ['formatted_address', 'geometry', 'name', 'address_components', 'website'],
      types: ['establishment']
    };

    autocomplete.value = new google.maps.places.Autocomplete(input, options);

    autocomplete.value.bindTo('bounds', map);

    autocomplete.value.setTypes(['bar', 'bakery', 'cafe', 'restaurant', 'food']);
    autocomplete.value.setComponentRestrictions({
      country: ['jp']
    });

    // 情報ウィンドウ
    infoWindow = new google.maps.InfoWindow();
    const infoWindowContent = document.getElementById('infoWindow-content') as HTMLElement;

    infoWindow.setContent(infoWindowContent);

    // AutoCompleteの結果が選択されたときのイベント
    autocomplete.value.addListener('place_changed', () => {
      infoWindow?.close();
      if (marker) marker.map = null; // 古いマーカーをクリア

      const place = autocomplete.value?.getPlace();

      if (!place?.geometry || !place.geometry.location) {
        window.alert(`「${place?.name}」 に該当する結果を得られませんでした。`);
        return;
      }

      // 地図の表示範囲を調整
      if (place.geometry.viewport) {
        map?.fitBounds(place.geometry.viewport);
      } else {
        map?.setCenter(place.geometry.location);
        map?.setZoom(17);
      }

      if (marker) {
        marker.position = place.geometry.location;
        marker.map = map; // マーカーを表示する
      }

      // 親コンポーネントに送信
      const lat = place.geometry.location.lat();
      const lng = place.geometry.location.lng();
      emits('update:location', { lat, lng });
      emits(
        'update:locationInfo',
        place.name as string,
        place.formatted_address as string,
        structureAddress(place.address_components as AddressComponent[])
      );

      // 情報ウィンドウの表示
      const placeNameElement = infoWindowContent.querySelector('#place-name') as HTMLElement;
      const placeAddressElement = infoWindowContent.querySelector('#place-address') as HTMLElement;
      if (placeNameElement) placeNameElement.textContent = place.name || '';
      if (placeAddressElement) placeAddressElement.textContent = place.formatted_address || '';
      infoWindow?.open(map, marker);
    });
  } catch (error) {
    console.error('Error initializing Google Maps:', error);
  }
}

function structureAddress(addressComponents: AddressComponent[]): StructuredAddress {
  const result: StructuredAddress = {
    postcode: '',
    prefecture: '',
    municipality: '',
    ward: '',
    district: ''
  };

  addressComponents.reverse().forEach((component) => {
    // 郵便番号
    if (component.types.includes('postal_code')) {
      result.postcode = component.long_name;
    }
    // 都道府県
    else if (component.types.includes('administrative_area_level_1')) {
      result.prefecture = component.long_name;
    }
    // 市町村
    else if (component.types.includes('locality')) {
      result.municipality = component.long_name;
    }
    // ○○区
    else if (component.types.includes('sublocality_level_1')) {
      result.ward = component.long_name;
    }
    // 地名
    else if (component.types.includes('sublocality_level_2')) {
      result.district = component.long_name;
    }
  });

  return result;
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
      { enableHighAccuracy: true, timeout: 3000, maximumAge: 0 }
    );
  } else {
    console.log('Geolocation is not supported by this browser.');
    initMap();
  }
});
</script>

<template>
  <FormLayout :label="label" :required="required" :iconComponent="iconComponent">
    <div class="relative">
      <input
        type="text"
        class="w-full rounded border border-gray-200 p-2 pr-9 font-body"
        id="pac-input"
        :placeholder="placeholder"
      />
    </div>
    <div class="flex justify-between">
      <FormErrorMessage class="mt-1" field-name="location" :errors="errors" />
    </div>

    <div ref="mapContainer" class="mt-5" style="width: 100%; height: 400px"></div>
    <div id="infoWindow-content" class="font-body font-normal">
      <span id="place-name" class="title"></span><br />
      <span id="place-address"></span>
    </div>
  </FormLayout>
</template>
