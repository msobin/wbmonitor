FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
        git \
        curl \
        wget \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        zlib1g-dev \
        libicu-dev \
        g++ \
        libmagickwand-dev \
        libxml2-dev \
        --no-install-recommends

# todo объединить после отладки конфигурации
RUN apt-get install -y libpq-dev
RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install mbstring zip xml gd mcrypt pdo_pgsql \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && pecl install xdebug-2.5.5 \
    && docker-php-ext-enable xdebug

RUN apt-get install -y librabbitmq-dev \
    && docker-php-ext-install sockets bcmath opcache

RUN pecl install amqp-1.9.4 \
    && docker-php-ext-enable amqp
# todo объединить после отладки конфигурации

RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/*

RUN rm -rf /usr/local/etc/php-fpm.d
COPY ./pools /usr/local/etc/php-fpm.d
COPY ./php-fpm.conf /usr/local/etc/php-fpm.conf
COPY ./php.ini /usr/local/etc/php/php.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

CMD ["php-fpm"]