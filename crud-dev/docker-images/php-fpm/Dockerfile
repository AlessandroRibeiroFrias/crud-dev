FROM php:7.1-fpm

RUN docker-php-ext-install mysqli pdo pdo_mysql gettext \
    && docker-php-ext-enable mysqli pdo pdo_mysql

ADD https://getcomposer.org/installer /tmp/composer-setup.php
RUN php /tmp/composer-setup.php -- --install-dir=/usr/local/bin --filename=composer

COPY ./docker-images/php-fpm/php-ini-overrides.ini /etc/php/7.1/fpm/conf.d/99-overrides.ini

WORKDIR "/var/www/app"
