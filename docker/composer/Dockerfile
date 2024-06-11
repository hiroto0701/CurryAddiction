FROM composer:latest

RUN apk upgrade --update
RUN apk add \
        libzip-dev \
        libpng-dev

RUN docker-php-ext-install gd
RUN docker-php-ext-enable gd