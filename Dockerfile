# ============================================================
# Stage 1: Build assets (Node + Vite)
# ============================================================
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm ci
COPY . .
RUN npm run build

# ============================================================
# Stage 2: PHP app
# ============================================================
FROM php:8.2-fpm-alpine AS app

# Instalar dependencias
RUN apk add --no-cache nginx supervisor mysql-client libpng-dev libjpeg-turbo-dev freetype-dev icu-dev

# Instalar extensiones PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd intl opcache

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Copiar assets compilados
COPY --from=assets /app/public/build public/build

# Instalar dependencias PHP y optimizar
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configuración Nginx (APUNTA A PUBLIC)
RUN echo 'server { \
    listen 80; \
    root /var/www/html/public; \
    index index.php; \
    location / { try_files $uri $uri/ /index.php?$query_string; } \
    location ~ \.php$ { \
        fastcgi_pass 127.0.0.1:9000; \
        fastcgi_index index.php; \
        include fastcgi_params; \
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
    } \
}' > /etc/nginx/http.d/default.conf

# Configuración Supervisor
RUN echo '[supervisord] \n\
nodaemon=true \n\
[program:nginx] \n\
command=nginx -g "daemon off;" \n\
[program:php-fpm] \n\
command=php-fpm' > /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
