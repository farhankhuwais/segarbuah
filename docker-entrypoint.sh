#!/bin/bash
set -e

# === FIX MPM: force remove event/worker at runtime, keep only prefork ===
rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.*
rm -f /etc/apache2/mods-available/mpm_event.* /etc/apache2/mods-available/mpm_worker.*

if [ ! -f /etc/apache2/mods-enabled/mpm_prefork.load ]; then
    a2enmod mpm_prefork 2>/dev/null || true
fi

echo "=== Apache MPM check ==="
ls -la /etc/apache2/mods-enabled/mpm_*.*
echo "=== End MPM check ==="

# Create storage link
php artisan storage:link --force 2>/dev/null || true

# Cache config & routes
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Run migrations
php artisan migrate --force 2>/dev/null || true

exec "$@"
