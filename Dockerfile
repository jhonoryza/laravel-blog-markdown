FROM jhonoryza/frankenphp-pgsql:8.2

WORKDIR /app
COPY . ./

RUN composer install --no-dev
RUN rm -rf ./git
