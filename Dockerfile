FROM webdevops/php-nginx:8.3-alpine

# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add zip unzip curl sqlite supervisor git

# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Installing PHP
RUN apk add php83 \
    php83-common \
    php83-fpm \
    php83-session \
    php83-pdo \
    php83-opcache \
    php83-zip \
    php83-phar \
    php83-iconv \
    php83-cli \
    php83-curl \
    php83-openssl \
    php83-mbstring \
    php83-tokenizer \
    php83-fileinfo \
    php83-json \
    php83-xml \
    php83-xmlwriter \
    php83-simplexml \
    php83-dom \
    php83-pdo_mysql \
    php83-pdo_sqlite \
    php83-tokenizer \
    php83-pecl-redis

# Enable GD library with JPEG and PNG support
# RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install \
#     bcmath \
#     ctype \
#     fileinfo \
#     mbstring \
#     pdo_mysql \
#     xml \
#     gd

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
    && php artisan optimize

# Permissions et utilisateur non-root
RUN chown -R application:application ./storage ./bootstrap/cache \
    && chmod -R 777 /app/storage /app/bootstrap/cache \
    chown -R application:application /app

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

