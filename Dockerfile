FROM jhonoryza/frankenphp-pgsql:8.2

WORKDIR /app
COPY . ./

RUN composer install --optimize-autoloader --no-interaction --no-plugins --no-scripts --prefer-dist --no-dev
RUN rm -rf /root/.composer

RUN rm -rf ./git
