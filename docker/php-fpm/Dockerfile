FROM php:7.3.6-fpm-alpine

RUN apk add --no-cache libxml2 libxml2-dev tzdata

ARG TZ=${TZ}

RUN cp /usr/share/zoneinfo/${TZ} /etc/localtime

RUN docker-php-ext-install bcmath ctype json mbstring pdo_mysql tokenizer xml

RUN mkdir -p /app

WORKDIR /app

COPY ./src /app/

RUN chmod -R a+w storage bootstrap/cache
