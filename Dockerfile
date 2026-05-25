FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libsqlite3-dev zip npm

RUN docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN touch /tmp/database.sqlite

RUN php artisan config:clear

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000