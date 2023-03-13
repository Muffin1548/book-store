FROM php:8.2-fpm

WORKDIR /var/www

RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list

RUN apt-get update; apt-get install --no-install-recommends --no-install-suggests -y  \
    git \
    unzip \
    libzip-dev \
    zip \
    symfony-cli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY --chown=www-data:www-data . /var/www/

USER www-data
