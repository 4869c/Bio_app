#!/bin/bash
set -e

cd /var/www/html

# Create a .env file if none exists (real environment variables from
# docker-compose still take priority over the values inside it).
if [ ! -f .env ]; then
    cp .env.example .env 2>/dev/null || touch .env
fi

# Generate an application key if one was not provided.
if [ -z "${APP_KEY}" ] && ! grep -q "^APP_KEY=base64" .env; then
    php artisan key:generate --force
fi

# Wait until the MySQL database is ready to accept connections.
echo "Waiting for the database..."
until php -r '
    $host = getenv("DB_HOST") ?: "db";
    $port = getenv("DB_PORT") ?: "3306";
    $user = getenv("DB_USERNAME") ?: "root";
    $pass = getenv("DB_PASSWORD") ?: "";
    try { new PDO("mysql:host=$host;port=$port", $user, $pass); }
    catch (Throwable $e) { exit(1); }
' 2>/dev/null; do
    sleep 3
done
echo "Database is ready."

# Create the tables, insert the demo data, and link the storage folder.
php artisan migrate --seed --force
php artisan storage:link 2>/dev/null || true

# Start the Apache web server.
exec apache2-foreground
