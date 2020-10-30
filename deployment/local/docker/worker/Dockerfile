FROM php:7.3-fpm

COPY . /var/www

WORKDIR /var/www

RUN apt-get update && apt-get install --assume-yes zlib1g-dev libzip-dev
RUN apt-get install --assume-yes --no-install-recommends libpq-dev librabbitmq-dev
RUN pecl install amqp

RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-install pdo pdo_pgsql zip bcmath
RUN docker-php-ext-enable amqp

RUN apt-get --assume-yes install git
RUN apt-get install unzip

RUN curl -sL https://getcomposer.org/installer | php -- --install-dir /usr/bin --filename composer

CMD php bin/console messenger:consume amqp -vv