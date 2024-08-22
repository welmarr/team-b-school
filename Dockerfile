FROM webdevops/php-nginx:8.3-alpine

# Installation dans votre Image du minimum pour que Docker fonctionne
# Installation des dépendances nécessaires
RUN apk add --no-cache \
    oniguruma-dev \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    zip \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    unzip \
    git \
    curl \
    libzip-dev \
    supervisor \
    bcmath \
    nano \
    && rm -rf /var/cache/apk/* /tmp/*


# Enable GD library with JPEG and PNG support
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    bcmath \
    ctype \
    fileinfo \
    mbstring \
    pdo_mysql \
    xml \
    gd

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration de l'environnement et de l'application
ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production
WORKDIR /app
COPY . .

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Installation et optimisation de Laravel
RUN composer install --no-interaction --optimize-autoloader --no-dev \
    && php artisan key:generate \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan cache:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan optimize:clear \
    && php artisan optimize \
    && rm -rf /usr/bin/composer

# Permissions et utilisateur non-root
RUN chown -R application:application /app \
    && chmod -R 777 /app/storage /app/bootstrap/cache

USER application

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

