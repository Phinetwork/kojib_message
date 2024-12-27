# Use an official PHP image as the base image, with Apache and PHP installed
FROM php:7.4-apache

# Install PHP extensions required by your application (e.g., MySQL support)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy the contents of the current directory (where the Dockerfile is) to the web server's document root
COPY ./chatscript /var/www/html/

# Expose port 80 for the web server
EXPOSE 80

# Set the working directory to the Apache document root
WORKDIR /var/www/html

# Ensure that Apache runs in the foreground when the container starts
CMD ["apache2-foreground"]
