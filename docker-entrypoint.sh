#!/bin/bash
set -e

# Default PORT to 80 if not set by Render or environment
PORT="${PORT:-80}"

# Dynamically set Apache listening port to match Render's $PORT environment variable
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Ensure storage subdirectories exist with correct permissions
mkdir -p /var/www/html/storage/framework/cache/data \
         /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/logs \
         /var/www/html/database

# Handle SQLite database creation if DB_CONNECTION is sqlite
if [ "$DB_CONNECTION" = "sqlite" ]; then
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        touch /var/www/html/database/database.sqlite
    fi
    chown -R www-data:www-data /var/www/html/database
    chmod -R 777 /var/www/html/database
fi

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create storage symlink if missing
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link --no-interaction || true
fi

# Run Package Discovery safely at container runtime
php artisan package:discover --ansi || true

# Run Artisan cache optimizations if in production and APP_KEY is set
if [ "$APP_ENV" = "production" ] && [ -n "$APP_KEY" ]; then
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

# Run database migrations if explicitly enabled via RUN_MIGRATIONS env var
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running database migrations..."
    php artisan migrate --force || true
fi

# Run database seeders if explicitly enabled via RUN_SEEDER env var
if [ "$RUN_SEEDER" = "true" ]; then
    echo "Running database seeders..."
    php artisan db:seed --force || true
fi

# Execute the container CMD (apache2-foreground)
exec "$@"
