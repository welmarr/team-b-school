FROM webdevops/php-nginx:8.3-alpine

RUN echo "UTC" > /etc/timezone
# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd


RUN apk add --no-cache --update \
    bzip2-dev \
    enchant2-dev \
    libpng-dev \
    gmp-dev \
    imap-dev \
    icu-dev \
    openldap-dev \
    freetds-dev \
    postgresql-dev \
    aspell-dev \
    net-snmp-dev \
    libxml2-dev \
    tidyhtml-dev  \
    libxslt-dev \
    libzip-dev \
    supervisor \
    nano \
    oniguruma-dev

RUN docker-php-ext-install \
    bcmath \
    bz2 \
    enchant \
    exif \
    ffi \
    gd \
    gettext \
    gmp \
    imap \
    intl \
    pcntl \
    pdo_mysql \
    soap \
    sockets \
    tidy \
    xml

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


