# Laminas/Mezzio (former Zend) Skeleton

## Directory structure

```
.docker/                            --> docker related configuration files
bin/                                --> folder for storing all executable scripts
config/                             --> configuration files
    autoload/                       --> config files which will be loaded automatically
        application.global.php      --> application config
    routes.php                      --> routes configuration
data/                               --> writable directory used by the cache 
migrations/                         --> migration files
public/                             --> web root 
    index.php                       --> application entry point
src/                                --> source files
tests/                              --> application tests
    _data/                          --> directory for fixture data
    _output/                        --> directory for output
    _support/                       --> directory for support code
    config/                         --> application related test configurations
        application.php             --> application config used during tests execution
        doctrine.php                --> database config used during tests execution
    functional/                     --> functional tests
    integration/                    --> integration tests
    unit/                           --> unit tests
    functional.suite.yml            --> codeception functional suite configuration
    integration.suite.yml           --> codeception integration suite configuration
    unit.suite.yml                  --> codeception unit suite configuration
.env                                --> environment application config
.env.example                        --> example environment configuration
codeception.yml                     --> codeception configuration file
composer.json                       --> composer configuration file
migrations.yml                      --> migrations configuration file
docker-compose.cd.yml               --> docker-compose configuration file used to build a production image
docker-compose.ci.yml               --> docker-compose configuration file used to run the automation tests
docker-compose.dev.yml              --> docker-compose configuration file used to start the application on development environment
docker-compose.prod.yml             --> docker-compose configuration file used to start the application on production environment
README.md                           --> application readme
```

## Requirements

You should have the following installed:

* docker >= 18
* docker-compose >= 1.22
* git
* MariaDB >= 10.1/ MySQL >= 5.7

## Installing

```
#clone the skeleton from the repository
git clone <url> ./
cd zend-api-skeleton

#copy .env.example as .env and configure the project with the correct credentials and parameters 
cp .env.example .env

#build the image
docker-compose -f docker-compose.dev.yml build

#start all service containers (demonized)
docker-compose -f docker-compose.dev.yml up -d

#stop all service containers
docker-compose -f docker-compose.dev.yml stop

#restart all service containers
docker-compose -f docker-compose.dev.yml restart
```

## Running Tests

```
#for code quality
docker-compose -f docker-compose.dev.yml exec -T php composer cs-check

#for functional tests
docker-compose -f docker-compose.dev.yml exec -T php composer test-functional

#for unit tests
docker-compose -f docker-compose.dev.yml exec -T php composer test-unit

#for integration tests
docker-compose -f docker-compose.dev.yml exec -T php composer test-integration

#for all tests
docker-compose -f docker-compose.dev.yml exec -T php composer test

#for all tests with coverage
docker-compose -f docker-compose.dev.yml exec -T php composer test-coverage

#for code quality and all tests
docker-compose -f docker-compose.dev.yml exec -T php composer check

#for run the calculation
php bin/console.php app:import Data/data.csv EUR:1,USD:0.987,GBP:0.878 GBP --vat=123465123
```

## Switching between development and production environment

```
#to enable dev mode
docker-compose -f docker-compose.dev.yml exec -T php composer development-enable

#to disable dev mode
docker-compose -f docker-compose.dev.yml exec -T php composer development-disable

#to check the status
docker-compose -f docker-compose.dev.yml exec -T php composer development-status
```

## Clear configuration cache

```
#to clear app config cache
docker-compose -f docker-compose.dev.yml exec -T php composer clear-config-cache
```

## Viewing logs

```
#to check php and application log entries
docker-compose -f docker-compose.dev.yml logs php

#to check nginx log entries
docker-compose -f docker-compose.dev.yml logs web

#to check database log entries
docker-compose -f docker-compose.dev.yml logs db

#to find something in the logs
docker-compose -f docker-compose.dev.yml logs php 2>&1 | grep <search_text>
```