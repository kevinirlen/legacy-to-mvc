# Stage 1: Install Composer and Git
FROM php:7.4-fpm AS composer
RUN apt-get update \
    && apt-get install -y --no-install-recommends wget git \
    && rm -rf /var/lib/apt/lists/* \
    && wget -O /usr/local/bin/composer https://getcomposer.org/composer-stable.phar \
    && chmod +x /usr/local/bin/composer

# Stage 2: Final image
FROM php:7.4-fpm
COPY --from=composer /usr/local/bin/composer /usr/local/bin/composer
COPY ./ /var/www/html
WORKDIR /var/www/html
RUN apt-get update \
    && apt-get install -y --no-install-recommends libpq-dev \
    && docker-php-ext-install mysqli pdo_pgsql pdo_mysql \
    && apt-get install -y git \
    && export PATH="$PATH:/usr/bin/git"