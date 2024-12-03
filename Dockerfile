# Use a PHP 5 image with Apache
FROM php:5.6-apache

# Copy your project files to the container
COPY . /var/www/html/

# Set permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
