FROM httpd:bookworm

RUN apt-get update -y

RUN apt-get install -y \
    php \
    php-mysql \
    libapache2-mod-php8.2 \
    && rm -r /var/lib/apt/lists/*

COPY . /var/www/html/

WORKDIR /var/www/html
