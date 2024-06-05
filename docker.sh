#!/bin/bash

docker run -d -p 3306:3306 --name bd -e MYSQL_ROOT_PASSWORD=root bd
docker run -it --rm --name php -d php
docker run -d -p 8080:80 --name apache -d apache
