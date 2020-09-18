FROM php:7.4-fpm-alpine

LABEL version="1.0" maintainer="support@devision.com"

WORKDIR /var/www/html/app

ARG APP_ENV

RUN apk update \
    && apk add --no-cache git curl g++ make autoconf libxml2-dev icu-dev nano shadow libzip-dev tzdata \
    && docker-php-source extract \
    && if [ "$APP_ENV" == "prod" ]; then pecl install apcu \
    && docker-php-ext-enable apcu; fi \
    && if [ "$APP_ENV" != "prod" ]; then pecl install xdebug \
    && docker-php-ext-enable xdebug; fi \
    && docker-php-source delete \
    && docker-php-ext-install pdo_mysql soap zip intl opcache \
    && apk del g++ make autoconf libxml2-dev \
    && rm -rf /tmp/* \
    #create a dedicated user and group for the application
    && addgroup -g 1000 -S appgroup \
    && adduser -u 1000 -D -S appuser -G appgroup \
    #add the application user to www-data group
    && usermod -aG www-data appuser \
    #change the app folder permissions
    && chown -R appuser:appgroup /var/www/html/app \
    && chmod -R g+rwx /var/www/html/app \
    #install composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./.docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./.docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./.docker/docker-entrypoint.sh /usr/local/bin
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 9000

#change the user to execute any further composer commands with appuser
USER appuser

#composer plugin used to speeds up the install process
RUN composer global require hirak/prestissimo --no-plugins --no-scripts

COPY ./composer.json composer.json
COPY ./composer.lock composer.lock
COPY --chown=appuser:appgroup . .

RUN composer install --no-interaction --no-progress $([ "$APP_ENV" == "prod" ] && echo "--no-dev") \
    && composer dump-autoload -o $([ "$APP_ENV" == "prod" ] && echo "--no-dev")

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
