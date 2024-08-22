FROM alpine:latest

# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add --no-cache zip unzip curl sqlite supervisor git mysql-client msmtp perl wget procps shadow libzip libpng libjpeg-turbo libwebp freetype icu icu-data-full

# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Installing PHP and necessary extensions
RUN apk add --no-cache php83 \
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


# Remove existing php symlink and create a new one pointing to php83
RUN [ -e /usr/bin/php ] && rm /usr/bin/php || true \
    && ln -s /usr/bin/php83 /usr/bin/php

    # Configure PHP
RUN mkdir -p /run/php/
RUN touch /run/php/php8.3-fpm.pid

COPY php-fpm.conf /etc/php83/php-fpm.conf
COPY php.ini-production /etc/php82/php.ini


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
    && chown -R application:application /app

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
