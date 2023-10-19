docker-compose up -d
docker exec -it test_app bash
php artisan migrate
php artisan passport:install

