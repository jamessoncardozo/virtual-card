FROM phpdockerio/php:8.2-fpm

# Set working directory
RUN mkdir -p /var/www/virtual-card
ARG user=jamesson
ARG uid=1000

WORKDIR /var/www/virtual-card

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/virtual-card

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    git \
    curl \
    ca-certificates \
    libargon2-dev \
    libcurl4-openssl-dev \
    libreadline-dev \
    libsodium-dev \
    libsqlite3-dev \
    libssl-dev \
    zlib1g-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
# RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer
RUN chown -R $user:www-data /home/$user
RUN chown -R $user:www-data /var/www/virtual-card


# Copy existing application directory contents
COPY . /var/www/virtual-card/

# Copy existing application directory contents
COPY ./docker/nginx/nginx.key  /etc/nginx/certificate/
COPY ./docker/nginx/nginx-certificate.crt  /etc/nginx/certificate/

# Copy existing application directory permissions
COPY --chown=$user:www-data . /var/www/virtual-card/

# Change current user to www
USER $user

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]