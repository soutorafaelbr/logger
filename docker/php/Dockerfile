FROM php:7.4-cli-alpine

RUN apk --no-cache update \
    && apk --no-cache upgrade

RUN docker-php-ext-install mysqli pdo_mysql pdo

ADD . /app

RUN chown -R www-data:www-data /app

COPY . /app

WORKDIR /app
