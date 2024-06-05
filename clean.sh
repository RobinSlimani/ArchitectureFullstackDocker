#!/bin/bash

docker rmi $(docker images -a -q) -f
docker stop php
docker stop bd
docker stop apache
docker container prune
