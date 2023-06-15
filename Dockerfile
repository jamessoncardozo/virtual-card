FROM php:8.2-fpm

ARG user
ARG uid
ARG gid

#Openssl Parameters from docker-compose.yml
ARG Country
ARG State
ARG Locality
ARG Organization
ARG OrganizationalUnit
ARG CommonName
ARG EmailAddress

# Aplication Folder
ARG APP_DIR=/var/www/virtual-card

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    git \
    curl \
    ufw \
    sudo \
    vim \
    nano \
    nginx \
    openssl \
    ca-certificates \
    libargon2-dev \
    libcurl4-openssl-dev \
    libreadline-dev \
    libsodium-dev \
    libssl-dev \
    zlib1g-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libmagickwand-dev --no-install-recommends

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
# Create system user to run Composer and Artisan Commands
RUN groupadd --gid $gid $user
RUN useradd -rm -d /home/$user -s /bin/bash -g root -G sudo,www-data -u $uid  $user
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

# Install the necessary imagick extension to generate the Qr Codes
RUN pecl install imagick && docker-php-ext-enable imagick

# Generate a Public and Priavate Key to nginx can use the HTTPS.
# You can set these variables on docker-compose.yml file

RUN mkdir -p /etc/nginx/certificate
RUN chmod -R a+rwx /etc/nginx/certificate

RUN openssl req -new -newkey rsa:4096 -x509 -sha256 -days 365 -nodes \
    -out /etc/nginx/certificate/nginx-certificate.crt \
    -keyout /etc/nginx/certificate/nginx.key \
    -subj "/C=${Country}/ST=${State}/L=${Locality}/O=${Organization}/OU=${OrganizationalUnit}/CN=${CommonName}/emailAddress=${EmailAddress}"

# Change directory user to nginx default user

RUN chown -R www-data:www-data $APP_DIR *
RUN chmod -R a+rwx $APP_DIR

RUN mkdir -p $APP_DIR/public/img/avatars
RUN mkdir -p $APP_DIR/public/img/qrcodes
RUN chmod -R a+rwx $APP_DIR/public/img

# Copy sites settings to nginx

RUN rm -rf /etc/nginx/sites-enabled/* && rm -rf /etc/nginx/sites-available/*
COPY ./docker/nginx/default.conf /etc/nginx/sites-enabled/default.conf

# Change current user to created user

USER $user

# Expose port 9000 and start php-fpm server
EXPOSE 80
EXPOSE 443

CMD ["php-fpm"]