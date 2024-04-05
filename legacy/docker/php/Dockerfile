FROM php:7.4-fpm
COPY ./ /var/www/html
WORKDIR /var/www/html
RUN apt-get update \
  && apt-get install -y --no-install-recommends libpq-dev \
  && docker-php-ext-install mysqli pdo_pgsql pdo_mysql