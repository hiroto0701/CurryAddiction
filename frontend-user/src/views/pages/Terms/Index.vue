<script setup lang="ts">
import BaseHeading from '@/views/atoms/document/BaseHeading.vue';
import BaseParagraph from '@/views/atoms/document/BaseParagraph.vue';
import BaseLink from '@/views/atoms/document/BaseLink.vue';
import BaseSection from '@/views/molecules/document/BaseSection.vue';
import BaseUnorderedList from '@/views/molecules/document/BaseUnOrderedList.vue';
import DocumentSection from '@/views/organisms/DocumentSection.vue';
</script>

<template>
  <div class="flex flex-col gap-12">
    <BaseHeading :level="1">利用規約</BaseHeading>
    <BaseParagraph>
      本規約は、本サービス（以下「本サービス」）の利用に関する条件を定めたものです。登録ユーザーは、本規約に同意の上、本サービスをご利用ください。
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
        'ユーザーサポートやお問い合わせ対応のため。',
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
        '本規約に違反したことがある場合',
        'ユーザーサポートやお問い合わせ対応のため。',
        'その他、運営者が不適切と判断した場合'
      ]"
    />

    <DocumentSection
      title="第4条（禁止事項）"
      :paragraphs="['登録ユーザーは、本サービスの利用にあたり、以下の行為を行ってはなりません。']"
      :list="[
        '法令または公序良俗に違反する行為',
        'サーバーに過度な負荷をかける行為',
        '他の登録ユーザーの情報を不正に取得する行為',
        'その他、運営者が不適切と判断する行為'
      ]"
    >
      <BaseParagraph>
        前項の定めにかかわらず、次に掲げる場合は第三者提供には該当しないものとします。
      </BaseParagraph>

      <BaseUnorderedList
        :items="[
          '運営者が利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を委託する場合',
          '合併その他の事由による事業の承継に伴って個人情報が提供される場合'
        ]"
      />

      <BaseParagraph>
        また、本サービスでは利用状況を把握し、サービスを改善するためにGoogle LLCが提供するGoogle
        Analyticsを利用しています。Google
        Analyticsは閲覧ページ毎のアクセス回数や滞在時間、利用環境や地域毎の利用者数、流入経路や検索語句等を分析する機能を提供しています。Google
        AnalyticsにはCookieなどデバイスに記録されている識別子や、IPアドレス、閲覧したサイトのURLやアプリの画面名等の情報が送信されます。Google
        Analyticsに関する詳しい説明は
        <BaseLink href="https://policies.google.com/technologies/ads?gl=jp">
          Google のサービスを使用するサイトやアプリから収集した情報Googleによる使用
        </BaseLink>
        をご覧ください。 Google AnalyticsによるCookieの利用を停止する方法は
        <BaseLink href="https://tools.google.com/dlpage/gaoptout?hl=ja">
          Google Analyticsオプトアウトアドオン
        </BaseLink>
        をご確認ください。
      </BaseParagraph>
    </DocumentSection>

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

    <BaseSection title="附則">
      <BaseUnorderedList :items="['2024年10月01日 制定']" />
    </BaseSection>
  </div>
</template>
