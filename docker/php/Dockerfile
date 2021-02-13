FROM php:fpm-alpine
RUN apk --update --no-cache add git autoconf alpine-sdk
RUN docker-php-ext-install pdo_mysql
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY conf.d/ /usr/local/etc/php/conf.d/
RUN echo "date.timezone = Europe/Berlin" > /usr/local/etc/php/php.ini
RUN echo "xdebug.remote_host = $(getent hosts docker.for.mac.localhost | awk '{ print $1 }')" >> /usr/local/etc/php/conf.d/xdebug.ini
WORKDIR /srv/app
CMD composer install ; bin/console doctrine:migrations:migrate ;  php-fpm
EXPOSE 9000