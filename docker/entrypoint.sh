#!/bin/sh
# First-run bootstrap: install dependencies, create .env and seed the SQLite database.
# Safe to run on every start, it only does what is missing.
set -e

if [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction
fi

if [ ! -f .env ]; then
    cp .env.example .env
fi

if ! grep -q '^APP_KEY=base64' .env; then
    php artisan key:generate --force
fi

if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
    php artisan migrate --seed --force
else
    php artisan migrate --force
fi

exec "$@"
