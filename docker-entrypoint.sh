#!/bin/bash
set -e

# === FIX MPM: force remove event/worker at runtime, keep only prefork ===
rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.*
rm -f /etc/apache2/mods-available/mpm_event.* /etc/apache2/mods-available/mpm_worker.*

if [ ! -f /etc/apache2/mods-enabled/mpm_prefork.load ]; then
    a2enmod mpm_prefork
fi

echo "=== Apache MPM check ==="
ls -la /etc/apache2/mods-enabled/mpm_*.*
echo "=== End MPM check ==="

# === Fix DB config: Railway injects MYSQLHOST etc. Export as DB_* for Laravel ===
export DB_HOST="${MYSQLHOST:-127.0.0.1}"
export DB_PORT="${MYSQLPORT:-3306}"
export DB_DATABASE="${MYSQLDATABASE:-laravel}"
export DB_USERNAME="${MYSQLUSER:-root}"
export DB_PASSWORD="${MYSQLPASSWORD:-}"
export APP_URL="${APP_URL:-https://segarbuah-production.up.railway.app}"

echo "DB_HOST=$DB_HOST DB_PORT=$DB_PORT DB_DATABASE=$DB_DATABASE"

# Create .env from example if missing
if [ ! -f .env ]; then
    cp .env.example .env
    echo ".env created from .env.example"
fi

# Generate APP_KEY if not set
php artisan key:generate --force --no-interaction || true

# Create storage link
php artisan storage:link --force || true

# Cache config & routes
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Run migrations
php artisan migrate --force || true

echo "=== Entrypoint complete ==="

exec "$@"
