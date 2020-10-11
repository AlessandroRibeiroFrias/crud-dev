FROM php:7.4-apache
RUN echo "Sevaneme localhost" >> /etc/apache2/apache2.conf
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
