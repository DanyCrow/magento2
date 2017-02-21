#!/usr/bin/env bash

magento cache:clean
docker exec -it git_web_1 -s /bin/bash -c "rm -rf var/di/*"
docker exec -it git_web_1 -s /bin/bash -c "rm -rf var/generation/*"
