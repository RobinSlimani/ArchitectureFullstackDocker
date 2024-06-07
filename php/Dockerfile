FROM php:8.1-apache

# ajout de l'application dnas le dossier web
COPY ./src/ /var/www/html/

# ajout du pdo pour pouvoir se connecter
RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 80
