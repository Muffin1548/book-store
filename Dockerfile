FROM php:8.2-fpm

WORKDIR /var/www

ARG COMPOSER_INSTALL_ARGS
ARG PHP_ENV

RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list

RUN apt-get update; apt-get install --no-install-recommends --no-install-suggests -y  \
    libc-client-dev \
    libkrb5-dev  \
    libpq-dev  \
    git \
    unzip \
    libzip-dev \
    zip \
    symfony-cli

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install \
    pdo \
    pgsql  \
    pdo_pgsql \
    opcache \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    composer install ${COMPOSER_INSTALL_ARGS}

COPY --chown=www-data:www-data . /var/www/

USER www-data
