<script setup lang="ts">
import { type Component } from 'vue';
import FormLayout from '@/views/templates/FormLayout.vue'

interface Props {
  readonly label: string;
  readonly required: boolean;
  readonly optional: boolean;
  readonly iconComponent: Component;
}

defineProps<Props>();
</script>
<template>
  <FormLayout :label="label" :required="required" :optional="optional" :iconComponent="iconComponent">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.873985289111!2d130.37126177569635!3d33.58262097333749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x354193c915f0ee39%3A0xb1db154a340d16ee!2z44Ki44OV44K_44O844Kw44Ot44Km!5e0!3m2!1sja!2sjp!4v1710258613983!5m2!1sja!2sjp" class="w-full h-96 mt-3" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </FormLayout>
</template>