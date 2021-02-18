ARG COMPOSER_VERSION=1.10
ARG PHP_VERSION=8.0

FROM composer:${COMPOSER_VERSION} AS composer
FROM php:${PHP_VERSION}

ENV TZ=Europe/Warsaw

RUN apt-get update \
    && apt-get install -y git libzip-dev unzip \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
    && pecl install redis \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && docker-php-ext-enable redis


COPY --from=composer /usr/bin/composer /usr/local/bin/composer

ARG UNIX_USER=1000

RUN adduser -u ${UNIX_USER} owner \
    && usermod -a -G www-data owner

ARG INSTALL_XDEBUG=false
RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    pecl install xdebug; \
    docker-php-ext-enable xdebug \
;fi

WORKDIR /app
EXPOSE 80

HEALTHCHECK --start-period=1m --interval=10s CMD curl --fail --silent -o /dev/null http://127.0.0.1:80/ || exit 1
ENTRYPOINT [ "/app/docker/entrypoint.sh" ]


