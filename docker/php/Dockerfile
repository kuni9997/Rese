FROM php:8.1.1-fpm

EXPOSE 5173

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip\
  && apt-get install -y supervisor

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

RUN apt-get update && \
  apt-get install -y zlib1g-dev libpng-dev libjpeg62-turbo-dev libwebp-dev && \
  docker-php-ext-configure gd --with-jpeg --with-webp && \
  docker-php-ext-install -j$(nproc) gd

RUN apt-get update \
  && apt-get install -y wget git unzip libpq-dev \
  && docker-php-ext-install pdo_mysql\
  && : 'Install Node.js' \
  &&  curl -sL https://deb.nodesource.com/setup_18.x | bash - \
  && apt-get install -y nodejs \
  && : 'Install PHP Extensions' \
  && docker-php-ext-install -j$(nproc) pdo_pgsql 

ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=composer /usr/bin/composer /usr/bin/composer


WORKDIR /var/www/
