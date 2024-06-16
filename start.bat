@echo off

start "Server" cmd /k "npm run dev"
start "Server" cmd /k "php artisan serve --host=localhost --port=8000"
start "Redis Server" "redis-server"

start "Server" cmd /k "php -S localhost:8080 -t utility/phpmyadmin"
start "Server" cmd /k "php -S localhost:8081 -t utility/phpredisadmin"
