FROM jhonoryza/frankenphp-pgsql:8.2

WORKDIR /app
COPY . ./

# Install dependencies menggunakan Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-plugins --no-scripts --prefer-dist

RUN rm -rf /root/.composer
RUN rm -rf ./git

# Jalankan FrankenPHP
CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=80", "--workers=2", "--max-requests=1000"]