<script setup lang="ts">
import { useStorageUrl } from '@/composables/useStorageUrl';
import CameraIcon from '@/views/atoms/icons/CameraIcon.vue';
import HeartIcon from '@/views/atoms/icons/HeartIcon.vue';
import SearchIcon from '@/views/atoms/icons/SearchIcon.vue';
import LoginButton from '@/views/molecules/buttons/LoginButton.vue';
import LpLogo from '@/views/molecules/lpComponents/LpLogo.vue';
import LpText from '@/views/molecules/lpComponents/LpText.vue';
import FeatureCard from '@/views/molecules/lpComponents/FeatureCard.vue';

const { getStorageUrl } = useStorageUrl();

const emits = defineEmits<{
  (e: 'openModal'): void;
}>();
</script>

<template>
  <section>
    <LpLogo title="Curry Addiction" sub-title="カレー好きのためのSNS" />
    <div class="mt-6 flex justify-center">
      <LoginButton text="ログイン" @click="emits('openModal')" />
    </div>
  </section>

  <section class="mt-16 flex flex-col items-center gap-8">
    <LpText
      text="Curry Addictionは、カレー好きのためのSNSです。好きなカレーを気軽に投稿して、辛さや具材、お店の雰囲気までカレーに関するすべてを共有しましょう。自分だけのカレーコレクションを作り上げていくことができます。"
    />
    <LpText
      text="カレーが大好きな作者が、もっと色んなカレーを知りたい！そして食べたカレーを共有することで、同じようなカレー好きの人に新たなカレーを知ってもらいたい！というカレーに対する熱い思いを込めてこのサービスを作り上げました。"
    />
    <LpText
      text="このサービスで、カレーとの出会いを記録し、依存症（addiction）になるほどカレーにハマるきっかけになればと思っています。"
    />
  </section>

  <section class="grid grid-cols-1 gap-4 py-12 sm:grid-cols-3">
    <FeatureCard
      :icon="CameraIcon"
      title="カレーを投稿"
      text="美味しかったカレーの写真と感想を共有しよう"
    />
    <FeatureCard
      :icon="HeartIcon"
      title="いいね &amp; 保存"
      text="お気に入りの投稿にいいねをしたり、保存したりできます"
    />
    <FeatureCard
      :icon="SearchIcon"
      title="カレーを検索"
      text="近くの美味しいカレー店を簡単に見つけられます"
    />
  </section>

  <div class="mt-16 flex flex-col gap-5">
    <div class="border-sumi-150 rounded-3xl border p-7 sm:flex sm:p-8">
      <div
        class="xs:gap-5 xs:text-md sm:text-md flex flex-1 flex-col items-start gap-4 text-sm leading-relaxed"
      >
        <h2 class="font-body text-sumi-900">
          早速Curry Addictionに参加して、あなただけのカレーコレクションを作り上げましょう。
        </h2>
        <LoginButton text="ログイン" @click="emits('openModal')" />
      </div>
      <div class="-mt-4 flex justify-end sm:mt-6">
        <img
          :src="getStorageUrl('/illust/circle_of_people.svg')"
          class="w-36 sm:w-44"
          alt="イラスト"
        />
      </div>
    </div>
  </div>
</template>
