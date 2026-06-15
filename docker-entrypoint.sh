#!/bin/bash
set -e

# Debug: check MPM modules
echo "=== Apache MPM check ==="
ls -la /etc/apache2/mods-enabled/mpm_*.* 2>&1 || echo "No MPM files found"
apache2ctl -M 2>&1 | grep -i mpm || echo "No MPM found via apache2ctl"
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
