#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
composer install -n
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for new $APP_ENV"
    cp .env.example .env
else
    echo "env file exists."
fi

php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear

php artisan serve --port=$PORT --host=0.0.0.0 --env=.env

exec docker-php-entrypoint "$@"