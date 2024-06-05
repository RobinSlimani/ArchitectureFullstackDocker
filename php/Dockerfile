FROM httpd:bookworm

RUN apt-get update -y

RUN apt-get install -y \
    php \
    php-mysql \
    libapache2-mod-php8.2 \
    && rm -r /var/lib/apt/lists/*


RUN echo "ServerName localhost" >> /usr/local/apache2/conf/httpd.conf
RUN echo "error_reporting(E_ALL);" >> /etc/php/8.2/apache2/php.ini
RUN echo "ini_set('display_errors', 1);" >> /etc/php/8.2/apache2/php.ini

COPY ./app1 /usr/local/apache2/htdocs/

WORKDIR /usr/local/apache2/htdocs/app1
