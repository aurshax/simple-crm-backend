# simple-crm-backend
Simple CRM Backend by Laravel

DOCKER
docker-compose down -v
docker-compose up -d --build

docker exec -it simplecrm-app bash

LARAVEL:
composer install
php artisan cache:table
php artisan migrate

php artisan --version

php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan config:cache

TEST Routes
php artisan route:list
