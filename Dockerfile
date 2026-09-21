FROM php:8.1-apache

# Install system packages and PHP extensions Laravel needs
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        zip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache URL rewriting for Laravel routes
RUN a2enmod rewrite

# Point Apache to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Allow Laravel .htaccess rules
RUN printf '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

WORKDIR /var/www/html

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application
COPY . .

# Install PHP packages exactly from composer.lock
RUN composer install \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# Laravel needs write access here
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache \
    && chmod -R 775 \
    storage \
    bootstrap/cache

COPY docker/start.sh /usr/local/bin/start.sh

RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80

CMD ["/usr/local/bin/start.sh"]