FROM webdevops/php-nginx:8.3-alpine

# Installation dans votre Image du minimum pour que Docker fonctionne
RUN apt-get update && apt-get install -y \
    libonig-dev \
    oniguruma-dev \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libxml2-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl \
    libzip-dev \
    supervisor \
    bcmath \
    nano

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    bcmath \
    ctype \
    fileinfo \
    mbstring \
    pdo_mysql \
    xml \
    gd


# Installation dans votre image de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer



ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production
WORKDIR /app
COPY . .

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf


# Installation et configuration de votre site pour la production
# https://laravel.com/docs/10.x/deployment#optimizing-configuration-loading
RUN composer install --no-interaction --optimize-autoloader --no-dev
# Generate security key
RUN php artisan key:generate
# Optimizing Route loading
# Clear various caches and configurations
RUN php artisan config:clear         # Clear the configuration cache
RUN php artisan route:clear          # Clear the route cache
RUN php artisan view:clear           # Clear the compiled view files
RUN php artisan cache:clear          # Clear the application cache
RUN php artisan config:cache         # Cache the configuration files
RUN php artisan route:cache          # Cache the routes
RUN php artisan view:cache           # Cache the views
RUN php artisan optimize:clear       # Clear all compiled classes and files
RUN php artisan optimize             # Optimize the framework for better performance

RUN chown -R application:application ./storage ./bootstrap/cache
RUN chmod -R 777 ./storage ./bootstrap/cache

RUN chown -R application:application ./app
CMD /usr/bin/supervisord
