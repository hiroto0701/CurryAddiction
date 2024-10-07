<script setup lang="ts">
import CardImg from '@/views/atoms/CardImg.vue';
import CardBody from '@/views/molecules/card/CardBody.vue';
import PostUserProfileLink from '@/views/molecules/links/PostUserProfileLink.vue';
import CardDropDown from '@/views/molecules/dropdown/CardDropDown.vue';

interface Props {
  readonly src: string;
  readonly storeName: string;
  readonly location: string;
  readonly date: string;
  readonly displayName: string;
  readonly handleName: string;
  readonly avatarUrl: string | null;
  readonly isLiked: boolean;
  readonly isArchived: boolean;
  readonly isMine: boolean;
}
defineProps<Props>();

const emits = defineEmits<{
  (e: 'navigateToDetail'): void;
  (e: 'like'): void;
  (e: 'archive'): void;
  (e: 'handlePost'): void;
}>();
</script>
<template>
  <article class="overflow-hidden rounded-lg border border-gray-200">
    <div class="flex h-14 items-center justify-between border-b border-gray-200 bg-white p-3">
      <PostUserProfileLink
        class="w-fit text-xs md:max-w-48"
        :display-name="displayName"
        :handle-name="handleName"
        :avatar-url
      />
      <CardDropDown :is-mine @handle-post="emits('handlePost')" />
    </div>
    <CardImg :src class="cursor-pointer md:hover:opacity-95" @click="emits('navigateToDetail')" />
    <CardBody
      :store-name="storeName"
      :location
      :date
      :is-liked
      :is-archived
      @like="emits('like')"
      @archive="emits('archive')"
    />
  </article>
</template>
