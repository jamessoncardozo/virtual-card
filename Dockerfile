FROM php:8.2-fpm

ARG user
ARG uid
ARG gid

# Aplication Folder
ARG APP_DIR=/var/www/virtual-card

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    git \
    curl \
    ufw \
    sudo \
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
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
# Create system user to run Composer and Artisan Commands
RUN groupadd --gid $gid $user
RUN useradd -rm -d /home/$user -s /bin/bash -g root -G sudo,www-data -u $uid --disabled-password --gecos '' --uid $USER_ID --gid $GROUP_ID $user
RUN mkdir -p /home/$user/.composer
RUN chown -R $user:$user /home/$user

# Set working directory
RUN mkdir -p $APP_DIR
WORKDIR $APP_DIR
RUN cd $APP_DIR

# Copy existing application directory contents
COPY . $APP_DIR
# Copy composer.lock and composer.json
COPY composer.lock composer.json $APP_DIR

# Copy existing ssl certificate to nginx

COPY ./docker/nginx/nginx-certificate.crt  /etc/nginx/certificate/

# Change directory user to nginx default user

RUN chown -R www-data:www-data $APP_DIR *
RUN chmod -R a+rwx $APP_DIR



# Change current user to www
USER $user

# Expose port 9000 and start php-fpm server
EXPOSE 9000
EXPOSE 8000
EXPOSE 80
EXPOSE 443

CMD ["php-fpm"]