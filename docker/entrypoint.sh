#!/bin/bash
set -e

echo "Aguardando MySQL estar pronto..."
while ! nc -z mysql 3306; do
  sleep 0.5
done

echo "MySQL está pronto!"

echo "Criando diretórios necessários..."
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/bootstrap/cache

echo "Configurando permissões..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage/logs

# Garantir que o arquivo de log possa ser criado
touch /var/www/html/storage/logs/laravel.log 2>/dev/null || true
chown www-data:www-data /var/www/html/storage/logs/laravel.log 2>/dev/null || true
chmod 664 /var/www/html/storage/logs/laravel.log 2>/dev/null || true

echo "Iniciando processo principal..."
exec "$@"
