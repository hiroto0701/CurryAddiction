<script setup lang="ts">
/// <reference types="google.maps" />
import { Loader } from '@googlemaps/js-api-loader';
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
let infoWindow: google.maps.InfoWindow;

const loader = new Loader({
  apiKey: import.meta.env.VITE_GOOGLE_MAP_API_KEY,
  version: 'weekly',
  libraries: ['places', 'marker'],
  region: 'JP',
  language: 'ja'
});

function createCustomInfoWindowContent(formattedAddress: string): string {
  const encodedName = encodeURIComponent(props.officialName);
  const encodedAddress = encodeURIComponent(formattedAddress);
  const googleMapsLink = `https://www.google.com/maps?q=${encodedName} ${encodedAddress}`;
  return `
    <div>
      <h3 class="text-base font-medium">${props.officialName}</h3>
      <p>${formattedAddress}</p>
      <a href="${googleMapsLink}" class="text-blue-600 md:hover:underline" target="_blank" rel="noopener noreferrer">GoogleMapで見る</a>
    </div>
  `;
}

async function initMap() {
  try {
    const { Map } = (await loader.importLibrary('maps')) as google.maps.MapsLibrary;
    const { AdvancedMarkerElement } = (await loader.importLibrary(
      'marker'
    )) as google.maps.MarkerLibrary;

    const mapOptions: google.maps.MapOptions = {
      center: { lat: props.latitude, lng: props.longitude },
      zoom: 16,
      mapId: 'import.meta.env.VITE_GOOGLE_MAP_ID'
    };

    if (!mapElement.value) {
      throw new Error('Map element not found');
    }

    map = new Map(mapElement.value, mapOptions);

    infoWindow = new google.maps.InfoWindow();

    marker = new AdvancedMarkerElement({
      position: { lat: props.latitude, lng: props.longitude },
      map: map
    });

    await reverseGeocode(props.latitude, props.longitude);
  } catch (error) {
    console.error('Error initializing map:', error);
    address.value = '地図の初期化に失敗しました';
  }
}

async function reverseGeocode(lat: number, lng: number): Promise<void> {
  const geocoder = new google.maps.Geocoder();
  const latlng = { lat, lng };

  try {
    const response = await geocoder.geocode({ location: latlng });
    if (response.results[0]) {
      const formattedAddress = response.results[0].formatted_address;
      address.value = formattedAddress;
      const content = createCustomInfoWindowContent(formattedAddress);
      infoWindow.setContent(content);
      infoWindow.open(map, marker);
    } else {
      throw new Error('No results found');
    }
  } catch (error) {
    console.error('Geocoder failed:', error);
    address.value = 'ジオコーディングに失敗しました';
    const content = createCustomInfoWindowContent('ジオコーディングに失敗しました');
    infoWindow.setContent(content);
    infoWindow.open(map, marker);
  }
}

onMounted(async () => {
  await initMap();
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
