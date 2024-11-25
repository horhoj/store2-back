FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
        unzip curl wget git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libxml2-dev \
        libzip-dev

RUN docker-php-ext-install -j$(nproc) iconv mysqli pdo_mysql zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#RUN pecl install xdebug-3.0.4 && docker-php-ext-enable xdebug

#RUN pecl install xdebug \
#    && docker-php-ext-enable xdebug \
#    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.client_host = 192.168.220.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#    && echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

WORKDIR /var/www/

CMD ["php-fpm"]
