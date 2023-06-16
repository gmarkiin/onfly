#!/bin/bash

docker-compose exec onfly-nginx bash -c "php artisan test"
