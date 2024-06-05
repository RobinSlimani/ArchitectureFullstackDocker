#!/bin/bash

docker stop php
docker stop bd
docker stop apache
docker container prune
docker rmi $(docker images -a -q)
