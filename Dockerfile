FROM php:8.3-apache

# Install the system libraries and PHP extensions that Laravel needs.
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libonig-dev \
        libzip-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mbstring bcmath gd zip \
    && rm -rf /var/lib/apt/lists/*

# Bring in Composer from its official image.
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Serve Laravel's public/ folder and enable pretty URLs.
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copy the application code into the image.
COPY . .

# Install PHP dependencies (production only) and prepare writable folders.
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts \
    && mkdir -p storage/framework/sessions \
               storage/framework/views \
               storage/framework/cache \
               storage/logs \
               bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Install the startup script (strip Windows line endings just in case).
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN sed -i 's/\r$//' /usr/local/bin/entrypoint.sh \
    && chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80
ENTRYPOINT ["entrypoint.sh"]
