FROM webdevops/php-nginx:8.3-alpine

RUN apk add oniguruma-dev libxml2-dev
RUN docker-php-ext-install \
    bcmath \
    ctype \
    fileinfo \
    mbstring \
    pdo_mysql \
    xml


# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration de l'environnement et de l'application
ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production
WORKDIR /app
COPY . .
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN touch ./storage/logs/worker.log
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


# Permissions et utilisateur non-root
RUN chown -R application:application ./storage ./bootstrap/cache \
    && chmod -R 777 /app/storage /app/bootstrap/cache \
    && chown -R application:application /app

#CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]


