#!/bin/bash
set -e

# Create storage link
php artisan storage:link --force 2>/dev/null || true

# Cache config & routes
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

exec "$@"
