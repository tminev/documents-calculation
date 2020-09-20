#! /bin/sh

#initialize working environment

composer clear-config-cache

if [ $APP_ENV = 'dev' ];
then
    #install all composer dependencies on the host machine (from the cache) to make the IDE autocomplete working
    composer install --optimize-autoloader --no-interaction
    composer development-enable
    composer migrate-test-db

    #wait for database initialization before the migration scripts
    #chmod +x .docker/wait-for.sh
    #.docker/wait-for.sh -t=100 $DB_HOST:$DB_PORT

    composer migrate-db
elif [ $APP_ENV = 'prod' ];
then
    composer development-disable
    composer migrate-db
elif [ $APP_ENV = 'test' ];
then
    composer development-enable

fi


#start php
exec php-fpm -F
