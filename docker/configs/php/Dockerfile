FROM php:8.2-fpm

RUN apt-get -y update && apt-get -y install git unzip vim
RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.discover_client_host=0" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_host=docker.for.mac.localhost" >> /usr/local/etc/php/conf.d/xdebug.ini

ENV TERM xterm-256color

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

WORKDIR /srv/src/container
CMD [ "php-fpm"]
