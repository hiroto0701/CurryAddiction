<script setup lang="ts">
/// <reference types="google.maps" />
import { ref, onMounted } from 'vue';
import type { Component } from 'vue';
import FormLayout from '@/views/templates/FormLayout.vue';
import FormErrorMessage from '@/views/atoms/ErrorMessage/FormErrorMessage.vue';

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
}>();

const mapContainer = ref<HTMLElement | null>(null);
const map = ref<google.maps.Map | null>(null);
const autocomplete = ref<google.maps.places.Autocomplete | null>(null);

function initMap(position?: GeolocationPosition) {
  if (mapContainer.value) {
    const defaultPosition = { lat: 35.6812, lng: 139.7671 }; // 東京駅をデフォルト位置にする
    const center = position
      ? { lat: position.coords.latitude, lng: position.coords.longitude }
      : defaultPosition;

    // 地図の初期化
    const mapOptions = {
      center,
      zoom: 15,
      mapTypeControl: true
    };

    map.value = new google.maps.Map(mapContainer.value, mapOptions);

    // AutoComplete初期化
    const input = document.getElementById('pac-input') as HTMLInputElement;
    const options = {
      fields: ['formatted_address', 'geometry', 'name', 'address_components', 'website'],
      types: ['establishment']
    };

    autocomplete.value = new google.maps.places.Autocomplete(input, options);

    autocomplete.value.bindTo('bounds', map.value);

    autocomplete.value.setTypes(['bar', 'bakery', 'cafe', 'restaurant', 'food']);
    autocomplete.value.setComponentRestrictions({
      country: ['jp']
    });

    // 詳細表示ツールチップ
    const infowindow = new google.maps.InfoWindow();
    const infowindowContent = document.getElementById('infowindow-content') as HTMLElement;

    infowindow.setContent(infowindowContent);

    const marker = new google.maps.Marker({
      map: map.value,
      anchorPoint: new google.maps.Point(0, -29)
    });

    // AutoCompleteの結果が選択されたときのイベント
    autocomplete.value.addListener('place_changed', () => {
      infowindow.close();
      marker.setVisible(false);

      const place = autocomplete.value?.getPlace();

      if (!place?.geometry || !place.geometry.location) {
        window.alert(`「${place?.name}」 に該当する結果を得られませんでした。`);
        return;
      }

      // 地図の表示範囲を調整
      if (place.geometry.viewport) {
        map.value?.fitBounds(place.geometry.viewport);
      } else {
        map.value?.setCenter(place.geometry.location);
        map.value?.setZoom(17);
      }

      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      // 緯度経度を親コンポーネントに送信
      const lat = place.geometry.location.lat();
      const lng = place.geometry.location.lng();
      emits('update:location', { lat, lng });

      // 情報ウィンドウの表示
      const placeNameElement = infowindowContent.querySelector('#place-name') as HTMLElement;
      const placeAddressElement = infowindowContent.querySelector('#place-address') as HTMLElement;
      if (placeNameElement) placeNameElement.textContent = place.name || '';
      if (placeAddressElement) placeAddressElement.textContent = place.formatted_address || '';
      infowindow.open(map.value, marker);

      // 検証用
      // 住所コンポーネントの型定義
      interface AddressComponent {
        long_name: string;
        short_name: string;
        types: string[];
      }

      interface StructuredAddressJP {
        postal_code: string;
        prefecture: string;
        city: string;
        ward: string;
        district: string;
        sublocality: string;
        premise: string;
        subpremise: string;
      }

      function structureAddressJP(addressComponents: AddressComponent[]): StructuredAddressJP {
        const result: StructuredAddressJP = {
          postal_code: '',
          prefecture: '',
          city: '',
          ward: '',
          district: '',
          sublocality: '',
          premise: '',
          subpremise: ''
        };

        addressComponents.reverse().forEach((component) => {
          // 郵便番号
          if (component.types.includes('postal_code')) {
            result.postal_code = component.long_name;
          }
          // 都道府県
          else if (component.types.includes('administrative_area_level_1')) {
            result.prefecture = component.long_name;
          }
          // 市町村
          else if (component.types.includes('locality')) {
            result.city = component.long_name;
          }
          // ○○区
          else if (component.types.includes('sublocality_level_1')) {
            result.ward = component.long_name;
          }
          // 地名
          else if (component.types.includes('sublocality_level_2')) {
            result.district = component.long_name;
          }
          // それ以降の番地など
          else if (component.types.some((type) => type.startsWith('sublocality'))) {
            result.sublocality += (result.sublocality ? '―' : '') + component.long_name;
          } else if (component.types.includes('premise')) {
            result.premise += result.premise + component.long_name;
          } else if (component.types.includes('subpremise')) {
            result.subpremise = component.long_name;
          }
        });

        return result;
      }

      const structuredAddress = structureAddressJP(place.address_components as AddressComponent[]);

      console.log(structuredAddress);
      console.log(place.address_components);
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
    <div id="infowindow-content" class="font-body font-normal">
      <span id="place-name" class="title"></span><br />
      <span id="place-address"></span>
    </div>
  </FormLayout>
</template>
