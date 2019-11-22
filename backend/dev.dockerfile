FROM php:7.2.2-fpm

RUN apt-get update && apt-get install -y mysql-client --no-install-recommends \
    && docker-php-ext-install pdo_mysql

RUN apt-get install -y curl nano && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get install -y git zip unzip libxml2-dev

RUN apt-get install -y software-properties-common

RUN add-apt-repository ppa:ondrej/php

RUN apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev

RUN apt-get install libpng-dev -y

RUN docker-php-ext-install mbstring

RUN docker-php-ext-install xml

RUN docker-php-ext-install zip 

RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

COPY ./ /var/www/backend

EXPOSE 9000 80
