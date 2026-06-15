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

# === Fix DB config: handle all Railway MySQL naming conventions ===
if [ -n "$MYSQL_URL" ]; then
    # Railway MySQL v2 via URL: mysql://user:pass@host:port/db
    export DB_HOST="$(echo "$MYSQL_URL" | sed -E 's|mysql://[^:]*:[^@]*@([^:/]*).*|\1|')"
    export DB_PORT="$(echo "$MYSQL_URL" | sed -E 's|.*:([0-9]+)/.*|\1|')"
    export DB_DATABASE="$(echo "$MYSQL_URL" | sed -E 's|.*/([^?]*).*|\1|')"
    export DB_USERNAME="$(echo "$MYSQL_URL" | sed -E 's|mysql://([^:]*):.*|\1|')"
    export DB_PASSWORD="$(echo "$MYSQL_URL" | sed -E 's|mysql://[^:]*:([^@]*)@.*|\1|')"
elif [ -n "$DATABASE_URL" ]; then
    # Generic DATABASE_URL fallback
    export DB_HOST="$(echo "$DATABASE_URL" | sed -E 's|.*@([^:/]*).*|\1|')"
    export DB_PORT="$(echo "$DATABASE_URL" | sed -E 's|.*:([0-9]+)/.*|\1|')"
    export DB_DATABASE="$(echo "$DATABASE_URL" | sed -E 's|.*/([^?]*).*|\1|')"
    export DB_USERNAME="$(echo "$DATABASE_URL" | sed -E 's|mysql://([^:]*):.*|\1|')"
    export DB_PASSWORD="$(echo "$DATABASE_URL" | sed -E 's|mysql://[^:]*:([^@]*)@.*|\1|')"
else
    # Individual variables — try new names (v2) first, then old names (v1)
    export DB_HOST="${MYSQL_HOST:-${MYSQLHOST:-127.0.0.1}}"
    export DB_PORT="${MYSQL_PORT:-${MYSQLPORT:-3306}}"
    export DB_DATABASE="${MYSQL_DATABASE:-${MYSQLDATABASE:-laravel}}"
    export DB_USERNAME="${MYSQL_USER:-${MYSQLUSER:-root}}"
    export DB_PASSWORD="${MYSQL_PASSWORD:-${MYSQLPASSWORD:-}}"
fi
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
