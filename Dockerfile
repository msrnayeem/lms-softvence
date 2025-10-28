# Base PHP image with Apache
FROM php:8.2-apache

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libonig-dev libzip-dev zip curl npm nodejs \
    && docker-php-ext-install pdo_mysql mbstring zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Copy entire app first (so artisan exists)
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Node dependencies
RUN npm install
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Start container: wait for DB then run Laravel
CMD bash -c "\
until php -r 'try { new PDO(\"mysql:host=${DB_HOST};dbname=${DB_DATABASE}\", \"${DB_USERNAME}\", \"${DB_PASSWORD}\"); } catch(PDOException \$e) { exit(1); }' 2>/dev/null; do \
  echo 'Waiting for MySQL...'; sleep 3; \
done; \
php artisan storage:link || true && \
php artisan migrate --seed && \
echo '✅ Laravel app is running at http://localhost:8000' && \
php artisan serve --host=0.0.0.0 --port=8000"
