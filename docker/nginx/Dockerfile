FROM nginx:1.16.0-alpine

ENV PHP_FPM_HOST=php-fpm

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /app/public

COPY ./src/public/ /app/public/
