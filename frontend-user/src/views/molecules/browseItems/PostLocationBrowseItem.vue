<script setup lang="ts">
/// <reference types="google.maps" />
import { ref, onMounted } from 'vue';
import LocationIcon from '@/views/atoms/icons/LocationIcon.vue';

interface Props {
  readonly officialName: string;
  readonly latitude: number;
  readonly longitude: number;
}

const props = defineProps<Props>();
const address = ref<string>('');
const mapElement = ref<HTMLElement | null>(null);

let map: google.maps.Map;
let marker: google.maps.marker.AdvancedMarkerElement;
let infowindow: google.maps.InfoWindow;

function createCustomInfoWindowContent(formattedAddress: string, lat: number, lng: number): string {
  const googleMapsLink = `https://www.google.com/maps?q=${props.officialName}${formattedAddress}`;
  return `
    <div>
      <p class="text-base font-medium">${props.officialName}</p>
      <p>${formattedAddress}</p>
      <a href="${googleMapsLink}" class="text-blue-600 md:hover:underline" target="_blank" rel="noopener noreferrer">GoogleMapで見る</a>
    </div>
  `;
}

async function initMap() {
  const { Map } = (await google.maps.importLibrary('maps')) as google.maps.MapsLibrary;
  const { AdvancedMarkerElement } = (await google.maps.importLibrary(
    'marker'
  )) as google.maps.MarkerLibrary;

  const mapOptions = {
    center: { lat: props.latitude, lng: props.longitude },
    zoom: 15,
    mapId: 'DEMO_MAP_ID'
  };
  map = new Map(mapElement.value!, mapOptions);

  infowindow = new google.maps.InfoWindow();

  marker = new AdvancedMarkerElement({
    position: { lat: props.latitude, lng: props.longitude },
    map: map
  });

  map.addListener('click', (event: google.maps.MapMouseEvent) => {
    if (event.latLng) {
      marker.position = event.latLng;
      reverseGeocode(event.latLng.lat(), event.latLng.lng());
    }
  });

  reverseGeocode(props.latitude, props.longitude);
}

function reverseGeocode(lat: number, lng: number) {
  const geocoder = new google.maps.Geocoder();
  const latlng = { lat, lng };

  geocoder
    .geocode({ location: latlng })
    .then((response) => {
      if (response.results[0]) {
        const formattedAddress = response.results[0].formatted_address;
        address.value = formattedAddress;
        const content = createCustomInfoWindowContent(formattedAddress, lat, lng);
        infowindow.setContent(content);
        infowindow.open(map, marker);
      } else {
        address.value = '住所が見つかりません';
        const content = createCustomInfoWindowContent('住所が見つかりません', lat, lng);
        infowindow.setContent(content);
        infowindow.open(map, marker);
      }
    })
    .catch((e) => {
      console.error('Geocoder failed due to: ' + e);
      address.value = 'ジオコーディングに失敗しました';
      const content = createCustomInfoWindowContent('ジオコーディングに失敗しました', lat, lng);
      infowindow.setContent(content);
      infowindow.open(map, marker);
    });
}

onMounted(() => {
  initMap();
});
</script>
<template>
  <div>
    <div class="mb-3 flex items-center gap-2">
      <LocationIcon />
      <h3 class="font-body font-medium leading-relaxed text-sumi-700">位置情報</h3>
    </div>
    <div ref="mapElement" style="width: 100%; height: 400px" class="mb-3"></div>
  </div>
</template>
