# CurryAddiction

ここに URL を記載。

## サービス概要

カレー界隈を盛り上げるための Web アプリケーションです。<br>
お気に入りのカレーを共有・発見することでユーザーをカレー依存症にしようという考えのもと開発を始めました。

## 使用技術

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

## ローカルで使ってみたい方へ

### 必要な環境

- docker 環境
- ブラウザ

シェルスクリプトを用意しているので main ブランチをクローン →CLI で`sh init.sh`を実行し、[http://localhost:8081](http://localhost:8081)にアクセスすることで使用可能です。
