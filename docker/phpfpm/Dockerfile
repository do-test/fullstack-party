FROM php:7.2-fpm

WORKDIR "/application"

# Install some dependencies
RUN apt-get update \
    && apt-get -y install libmcrypt-dev libcurl4-gnutls-dev libmemcached-dev zlib1g-dev

# And then official php extensions
RUN docker-php-ext-install curl mbstring

# Strange, but they don't provide Memcached extension, will grab from pecl
RUN pecl install memcached
RUN docker-php-ext-enable memcached

# Clean up to save space
RUN apt-get clean -y && rm -rf /var/lib/apt/lists/* /usr/share/doc/*

EXPOSE 9000
