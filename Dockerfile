# Gunakan image PHP 8.2 sebagai dasar
FROM php:8.2-fpm

# Install paket-paket sistem yang diperlukan
RUN apt-get update && apt-get install -y \
    mariadb-client \
    git \
    curl \
    zip \
    nodejs
    # npm

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"
    
# Bersihkan setelah instalasi paket
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instal ekstensi PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN docker-php-ext-install opcache

# Instal Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instal Node.js dan npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

COPY docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Buat pengguna non-root dan atur kepemilikan file aplikasi
RUN groupadd -g 1000 www \
    && useradd -u 1000 -ms /bin/bash -g www www
USER www

# Setel direktori kerja
WORKDIR /var/www/html

# Salin file aplikasi ke dalam kontainer
COPY --chown=www:www . .

# Kenalkan port yang digunakan oleh server web Anda (misalnya, 80)
EXPOSE 80

# Mulai proses PHP-FPM
CMD [ "php-fpm" ]
