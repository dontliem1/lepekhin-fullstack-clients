FROM php:8.0-fpm

# Install system dependencies and PHP extensions
RUN apt-get update
RUN apt-get install -y \
    nginx \
    libpq-dev \
    libzip-dev \
    zip \
    git \
    libpq-dev \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev
RUN docker-php-ext-configure zip
RUN docker-php-ext-install pdo pdo_pgsql pgsql intl sockets zip mbstring exif pcntl bcmath gd
RUN pecl install -o -f redis
RUN docker-php-ext-enable redis

# Copy Nginx configuration
COPY nginx/default.conf /etc/nginx/conf.d/

# Copy application
COPY . /var/www/html/

# Copy custom ini file
#COPY php/php.ini /usr/local/etc/php/php.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose ports
EXPOSE 80

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm

#ENV APP_ENV=production

# Specify working directory
WORKDIR /var/www/html
