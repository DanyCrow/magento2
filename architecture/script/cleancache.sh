#!/usr/bin/env bash

magento cache:clean
docker exec -it git_web_1 rm -rf /var/www/var/di
docker exec -it git_web_1 su www-data -s /bin/bash -c "mkdir -p /var/www/var/di"
docker exec -it git_web_1 rm -rf /var/www/var/generation
docker exec -it git_web_1 su www-data -s /bin/bash -c "mkdir -p /var/www/var/generation"
