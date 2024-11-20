<script setup lang="ts">
import BaseHeading from '@/views/atoms/document/BaseHeading.vue';
import BaseParagraph from '@/views/atoms/document/BaseParagraph.vue';
import BaseSection from '@/views/molecules/document/BaseSection.vue';
import BaseUnorderedList from '@/views/molecules/document/BaseUnOrderedList.vue';
import DocumentSection from '@/views/organisms/DocumentSection.vue';
</script>

<template>
  <div class="flex flex-col gap-12">
    <BaseHeading :level="1">利用規約</BaseHeading>
    <BaseParagraph>
      本規約は、Curry
      Addiction（以下「本サービス」）の利用に関する条件を定めたものです。ユーザーは、本規約に同意の上、本サービスをご利用ください。
    </BaseParagraph>

    <DocumentSection
      title="第1条（適用）"
      :paragraphs="['本規約は、本サービスの利用に関する一切の関係に適用されます。']"
    />

    <DocumentSection
      title="第2条（登録）"
      :paragraphs="[
        '登録希望者は、本規約に同意の上、運営者の定める方法により利用登録を行うものとします。',
        '登録希望者が以下のいずれかに該当する場合、運営者は登録を拒否することがあります。'
      ]"
      :list="[
        '虚偽の情報を登録した場合',
        '本規約に違反したことがある場合',
        'その他、運営者が不適切と判断した場合'
      ]"
    />

    <DocumentSection
      title="第3条（位置情報の利用）"
      :paragraphs="[
        '本サービスは、投稿機能の一部においてユーザーの現在位置情報を取得する場合があります。',
        '位置情報は、ブラウザの許可を得た場合にのみ取得され、保存されることはありません。',
        'ユーザーは位置情報の取得を拒否することができますが、一部の機能が制限される場合があります。',
        '位置情報は以下の目的で使用されます。'
      ]"
      :list="[
        '投稿内容に関連する情報を提供するため',
        'サービス内において店舗検索時のより良い体験を提供するため'
      ]"
    />

    <DocumentSection
      title="第4条（禁止事項）"
      :paragraphs="['ユーザーは、本サービスの利用にあたり、以下の行為を行ってはなりません。']"
      :list="[
        '法令または公序良俗に違反する行為',
        'サーバーに過度な負荷をかける行為',
        '他の登録ユーザーの情報を不正に取得する行為',
        'その他、運営者が不適切と判断する行為'
      ]"
    />

    <DocumentSection
      title="第5条（サービス内容の変更・終了）"
      :paragraphs="[
        '本サービスは個人による運営のため、予告なくサービスの内容を変更または提供を終了する場合があります。',
        'サービス提供を終了する場合、運営者はすべてのデータを削除することを約束します。'
      ]"
    />

    <DocumentSection
      title="第6条（免責事項）"
      :paragraphs="[
        '本サービスは、サービス提供の中断、終了、変更によりユーザーが被った損害について一切の責任を負いません。',
        '本サービスは、ユーザー間または第三者とのトラブルに関して責任を負いません。'
      ]"
    />

    <DocumentSection
      title="第7条（規約の変更）"
      :paragraphs="[
        '運営者は、本規約を必要に応じて変更することができます。変更後の規約は、本サービス上に掲載したときから効力を生じます。'
      ]"
    />

    <BaseSection title="附則">
      <BaseUnorderedList :items="['2024年10月01日 制定']" />
    </BaseSection>
  </div>
</template>
