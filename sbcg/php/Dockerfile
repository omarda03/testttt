# Use the official PHP image from Docker Hub
FROM php:7.4-apache

# Copy your PHP project files to the web root directory
COPY . /var/www/html/

# Expose port 80 to allow external access
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
