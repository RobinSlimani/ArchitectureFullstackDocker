FROM php:8.1-apache

COPY ./src/ /var/www/html/

RUN docker-php-ext-install pdo pdo_mysql
COPY ./my-httpd.conf /usr/local/apache2/conf/httpd.conf

EXPOSE 80
