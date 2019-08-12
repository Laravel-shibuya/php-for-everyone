FROM php:7.3.6-cli-alpine

RUN apk add --no-cache libxml2 libxml2-dev tzdata

ARG TZ=${TZ}

RUN cp /usr/share/zoneinfo/${TZ} /etc/localtime

RUN docker-php-ext-install bcmath ctype json mbstring pdo_mysql tokenizer xml

RUN mkdir -p /app

WORKDIR /app

RUN apk add --no-cache autoconf make gcc g++

RUN pecl install \
    xdebug \
    timecop-beta

RUN docker-php-ext-enable xdebug timecop
