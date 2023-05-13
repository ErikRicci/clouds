FROM php:8.2-apache

# Get Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --version=2.5.5 && \
    rm composer-setup.php && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Install Packages
RUN	apt-get update && \
    apt-get install -y git zip unzip libzip-dev nano libpng-dev && \
    apt-get autoremove -y && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*;

# Install PHP Extensions
RUN docker-php-ext-install pdo pdo_mysql zip gd sockets && \
    pecl install redis && \
    docker-php-ext-enable redis && \
    rm -rf /tmp/pear

# App Configurations
COPY . /src
WORKDIR /src
RUN composer install --no-cache --optimize-autoloader --no-dev

# Apache Configurations
RUN a2enmod rewrite; \
    chown -R www-data:www-data /src/storage; \
    rm -rf /var/www/html && \
    ln -s /src/public /var/www/html
