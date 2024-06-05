FROM mysql:latest

COPY init.sql /docker-entrypoint-initdb.d/

ENV MYSQL_ROOT_PASSWORD=root_password
ENV MYSQL_DATABASE=ma_base
ENV MYSQL_USER=user
ENV MYSQL_PASSWORD=user_password

EXPOSE 3306

CMD ["mysqld", "--character-set-server=utf8mb4", "--collation-server=utf8mb4_unicode_ci"]
