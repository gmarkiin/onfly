#!/bin/bash

cp .env.example .env &&
cp docker-compose.yml.example docker-compose.yml &&
docker-compose up -d &&
docker-compose exec onfly-nginx bash -c "su -c \"composer install\" application" &&
docker-compose exec onfly-nginx bash -c "su -c 'php artisan key:generate' application" &&
docker-compose exec onfly-nginx php artisan migrate
