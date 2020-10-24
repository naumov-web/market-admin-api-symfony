FROM php:7.3-fpm

COPY . /var/www

WORKDIR /var/www

RUN apt-get update && apt-get install --assume-yes zlib1g-dev libzip-dev
RUN apt-get install --assume-yes --no-install-recommends libpq-dev
RUN apt install --assume-yes librdkafka-dev libsodium-dev

RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-install pdo pdo_pgsql zip bcmath sodium

RUN pecl install rdkafka
RUN docker-php-ext-enable rdkafka

RUN apt-get --assume-yes install git
RUN apt-get install unzip

RUN curl -sL https://getcomposer.org/installer | php -- --install-dir /usr/bin --filename composer

CMD composer install --working-dir=/var/www && php-fpm
