cp ./laravel/.env.example ./laravel/.env

# コンテナ作成
docker compose up -d --build

# APIコンテナComposerインストール
docker compose run --rm curry_addiction_composer install --ignore-platform-reqs
docker compose run --rm curry_addiction_composer dump-autoload
# APIコンテナ設定関連処理
docker exec curry_addiction_php-fpm chmod -R 777 storage/ /bin/bash
docker exec curry_addiction_php-fpm php artisan key:generate

# DB生成
docker exec curry_addiction_php-fpm php artisan migrate --seed

# フロントエンドコンテナnpmインストール&再起動
docker compose run curry_addiction_frontend-user npm install
docker compose up -d curry_addiction_frontend-user
docker compose run curry_addiction_frontend-admin npm install
docker compose up -d curry_addiction_frontend-admin
