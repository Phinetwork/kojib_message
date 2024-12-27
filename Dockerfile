# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Update the system and install required dependencies for PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libc-client-dev \
    libmagickwand-dev \
    libkrb5-dev \
    curl \
    unzip \
    libxml2-dev \
    zlib1g-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install exif imap gd zip mysqli pdo_mysql bcmath mbstring dom opcache \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Ensure necessary directories exist and set permissions
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy application files to the Apache web root
COPY ./chatscript /var/www/html/

# Reset permissions after copying files to ensure correct ownership
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 for the Apache server
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
