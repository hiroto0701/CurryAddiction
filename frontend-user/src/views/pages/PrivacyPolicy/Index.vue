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
    <BaseHeading :level="1">プライバシーポリシー</BaseHeading>
    <BaseParagraph>
      本サービスは、以下のプライバシーポリシーを定め、個人の情報に関する保護法（平成十五年法律第五十七号、以下「個人情報保護法」）を遵守すると共に、適切なプライバシー情報の保護に努めます。
    </BaseParagraph>

    <DocumentSection
      title="第1条（プライバシー情報の定義）"
      :paragraphs="[
        'プライバシー情報とは、個人情報、履歴情報および特性情報を言います。',
        'プライバシー情報のうち「個人情報」とは、個人情報保護法にいう「個人情報」を指すものとし、生存する個人に関する情報であって、当該情報に含まれる氏名、連絡先その他の記述等により特定の個人を識別できる情報を指します。',
        'プライバシー情報のうち「履歴情報および特性情報」とは、上記に定める「個人情報」以外のものを指し、ご利用いただいたサービスやご覧になったページ、広告の履歴、登録ユーザーが検索された検索キーワード、ご利用日時、ご利用の方法、ご利用環境、登録ユーザーのIPアドレス、Cookie、端末の個体識別情報など、登録ユーザーがサービスを利用する際の履歴に関する情報や、登録ユーザーの有する特性に関する情報を指します。'
      ]"
    />

    <DocumentSection
      title="第2条（プライバシー情報の収集方法）"
      :paragraphs="[
        '本サービスは、アカウントの有効性の確認やアカウントの保護のため、登録ユーザーが利用登録をする際にメールアドレスなどのプライバシー情報をお尋ねすることがあります。',
        '本サービスは、利便性の向上のため、登録ユーザーについて、IPアドレス、Cookie、ローカルストレージなどの履歴情報および特性情報を、登録ユーザーが本サービスを利用し、またはページを閲覧する際に収集します。',
        'プライバシー情報のうち「履歴情報および特性情報」とは、上記に定める「個人情報」以外のものを指し、ご利用いただいたサービスやご覧になったページ、広告の履歴、登録ユーザーが検索された検索キーワード、ご利用日時、ご利用の方法、ご利用環境、登録ユーザーのIPアドレス、Cookie、端末の個体識別情報など、登録ユーザーがサービスを利用する際の履歴に関する情報や、登録ユーザーの有する特性に関する情報を指します。'
      ]"
    />

    <DocumentSection
      title="第3条（プライバシー情報を収集・利用する目的）"
      :paragraphs="['本サービスにおいてプライバシー情報を収集・利用する目的は、以下のとおりです。']"
      :list="[
        '登録ユーザーに本サービスを提供するため',
        '登録ユーザーに自身の登録情報の閲覧や修正、利用状況の閲覧を行っていただくため',
        'ユーザーサポートやお問い合わせ対応のため。',
        '不正行為やセキュリティ対策のため。',
        '本サービスのサービス向上のための調査、分析をするため。'
      ]"
    />

    <DocumentSection
      title="第4条（プライバシー情報の安全管理措置）"
      :paragraphs="[
        '運営者は、個人情報の正確性及び安全性を確保するために、セキュリティ対策をはじめとする安全対策を実施し、個人情報の漏えい、滅失またはき損の防止及び是正に努めます。'
      ]"
    />

    <DocumentSection
      title="第5条（プライバシー情報の第三者提供）"
      :paragraphs="[
        '運営者は、次に掲げる場合を除いて、予め登録ユーザーの同意を得ることなく、第三者に個人情報を提供することはありません。ただし、個人情報保護法その他の法令で認められる場合を除きます。'
      ]"
      :list="[
        '人の生命、身体または財産の保護のために必要がある場合であって、本人の同意を得ることが困難であるとき',
        '公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合であって、本人の同意を得ることが困難であるとき',
        '国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって、本人の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき',
        '予め次の事項を告知あるいは公表をしている場合',
        '利用目的に第三者への提供を含むこと',
        '第三者に提供されるデータの項目',
        '第三者への提供の手段または方法',
        '本人の求めに応じて個人情報の第三者への提供を停止すること'
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
      title="第6条（本サービス）"
      :paragraphs="[
        '本サービスは個人により運営されています。そのため、運営者の判断により、予告なくサービスの提供を終了することがあります。'
      ]"
    />

    <DocumentSection
      title="第7条（プライバシーポリシーの変更）"
      :paragraphs="[
        '本ポリシーの内容は、登録ユーザーに通知することなく、変更できるものとします。運営者が別途定める場合を除いて、変更後のプライバシーポリシーは、本ページに掲載したときから効力を生じるものとします。'
      ]"
    />

    <BaseSection title="附則">
      <BaseUnorderedList :items="['2024年10月01日 制定']" />
    </BaseSection>
  </div>
</template>
