# Use the official PHP Apache image
FROM php:8.0-apache

# Install necessary extensions (for example, MySQL extension)
RUN docker-php-ext-install mysqli

# Enable mod_rewrite for Apache (important for URL rewriting)
RUN a2enmod rewrite

# Copy your PHP app into the container
COPY ./ /var/www/html/

# Expose port 80 for HTTP
EXPOSE 80

# Set the working directory inside the container
WORKDIR /var/www/html
