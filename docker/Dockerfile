# The documentation for this dockerfile can be found on
# https://webdevpro.net/utiliser-symfony-dans-docker/
#
# This Dockerfile is used by the companion file docker-compose.yml
# which is processed by callin  `docker-compose up -d`

FROM php:7.2-fpm-alpine

ENV PHP_MEMORY_LIMIT=-1

# Apk install
RUN apk --no-cache update && apk --no-cache add bash acl yarn openssl wkhtmltopdf

# Set timezone
RUN apk  --no-cache  upgrade --update \
  && apk  --no-cache add -U tzdata \
  && cp /usr/share/zoneinfo/Europe/Brussels /etc/localtime \
  && apk del tzdata

# Documentation of this helper
# https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions apcu intl pdo_mysql zip xml soap curl iconv json ctype gd

# Add OPCache
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"

RUN docker-php-ext-install opcache

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer


# Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/html

# TODO add CMD to automize initialization ? Only one CMD allowed!
