FROM php:8.0.6-fpm-alpine3.13

RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html

# RUN apk add update && \
#     apk add install -y nano vim tree git libzip-dev zip gnupg && \
#     docker-php-ext-configure zip && \
#     docker-php-ext-install zip && \
#     docker-php-ext-install pdo_mysql && \
#     docker-php-ext-install mysqli && \
#     docker-php-ext-install bcmath && \
#     pecl install xdebug && \
#     docker-php-ext-enable xdebug

# RUN apk add install -y libpng-dev libfreetype6-dev libjpeg62-turbo-dev && \
#     docker-php-ext-configure gd && \
#     docker-php-ext-install -j$(nproc) gd && \
#     docker-php-ext-install exif


RUN docker-php-ext-install mysqli 
RUN docker-php-ext-install pdo_mysql 

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer /usr/bin/composer /usr/bin/composer


CMD php-fpm

EXPOSE 9000