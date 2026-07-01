#!/bin/sh
set -e

echo "🔄 Verificando y ejecutando migraciones pendientes..."
php artisan migrate --force

echo "🧹 Optimizando cachés de configuración/rutas/vistas..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "🚀 Iniciando Nginx + PHP-FPM..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
