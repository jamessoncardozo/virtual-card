# Use the PHP base image with built-in Nginx
FROM php:8.2.4-fpm

# Install necessary dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor

# Copy project files to the working directory in the container
COPY . /var/www/virtual-card

# Configure Nginx server
COPY docker/nginx.conf /etc/nginx/sites-available/project1

# Copy the supervisor configuration file
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set the working directory
WORKDIR /var/www/virtual-card

# Install Laravel dependencies
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# Copy custom Nginx configuration file
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Set correct permissions for Laravel storage folders
RUN chown -R www-data:www-data \
    /var/www/virtual-card/storage \
    /var/www/virtual-card/bootstrap/cache

# Expose Nginx ports
EXPOSE 80
EXPOSE 443

# Run Nginx server and supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
