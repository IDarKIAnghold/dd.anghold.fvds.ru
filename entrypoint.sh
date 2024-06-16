
if [ ! -L /var/www/public/storage ]; then
  php artisan storage:link
fi

if [ ! -L /var/www/public/build ]; then
  npm run build
fi

php-fpm
