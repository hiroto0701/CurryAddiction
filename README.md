# CurryAddiction

[https://curry-addiction.com/](https://curry-addiction.com/)
※ 現在API停止中

## サービス概要

カレー界隈を盛り上げるための Web アプリケーションです。<br>
お気に入りのカレーを共有・発見することでユーザーをカレー依存症にしようという考えのもと開発を始めました。

## サイトイメージ
### トップページ（LP）
![curry-addiction com_](https://github.com/user-attachments/assets/b06721f2-ee49-4a40-b5f7-ec4ddfcfa2d3)

## 主な機能

- ログイン
- 投稿
  - 一覧表示（設定によって、表示するカレーのジャンルや都道府県を絞り込むことも可能）
  - 詳細表示
  - 削除
  - いいね
  - 保存
- 検索
  - Google Places APIを使用して現在地を取得 → 任意の店舗やワードで検索することでヒットした店舗にピンを表示
- 通知
  - いいねされた投稿は通知（アプリケーション内のみ）が作成されます
- マイページ
  - 自分の投稿のみが表示されます
- ダッシュボード
  - カレンダーヒートマップを使用して投稿した日を分かりやすくしている
  - いいねした投稿、保存した投稿のみを表示
  - ごみ箱には削除された投稿を集約。30日後に自動で物理削除。
  - 設定では表示名、アバター、好きなカレーのジャンル、表示したい投稿の都道府県をそれぞれ設定できます

## 技術スタック

### dev

- Frontend

  - Vue.js(Composition API)

- Backend(API)

  - Laravel

- Database

  - Postgresql

- CSS FrameWork
  - TailwindCSS
- Develop Environment(Local)
  - Docker
  - Docker Compose
  - MinIO(an alternative to Amazon S3)

### production

- Frontend
  - Vue.js(Firebase hosting)

- Backend(API)
  - Laravel(GCP Cloud run)

- DB
  - Postgresql(Supabase)

- Object Storage
  - Cloudflare R2

- Session Management
  - Redis(upStash)
 
### DNS
cloudflareのネームサーバーを使用しDNSレコードを一括管理。
ネームサーバーかつCDNとしてcloudflareを活用。

## ローカルで使ってみたい方へ

### 必要な環境

- docker 環境
- ブラウザ

シェルスクリプトを用意しているので main ブランチをクローン →CLI で`sh init.sh`を実行し、[http://localhost:8081](http://localhost:8081)にアクセスすることで使用可能です。
