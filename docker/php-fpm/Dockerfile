FROM php:8.2-fpm

ENV TZ=Asia/Tokyo

COPY . /var/www/html

# php-fpmの設定ファイルをコピー
COPY www.conf /etc/php-fpm.d/www.conf

RUN apt-get update && \
    apt-get -y install \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    git \
    zip \
    unzip \
    vim \
    libpq-dev \
    libicu-dev \
    && git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis \
    && docker-php-ext-install pdo_pgsql bcmath intl redis

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html