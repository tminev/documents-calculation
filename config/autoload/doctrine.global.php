<?php

use Doctrine\Common\Cache\ApcuCache;
use Doctrine\DBAL\Driver\PDOMySql\Driver;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Infrastructure\Factories\DoctrineEntityManagerFactory;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'dependencies' => [
        'factories' => [
            UnderscoreNamingStrategy::class => InvokableFactory::class,
            EntityManager::class => DoctrineEntityManagerFactory::class,
        ],
    ],
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => Driver::class,
                'host' => getenv('DB_HOST'),
                'port' => getenv('DB_PORT'),
                'user' => getenv('DB_USER'),
                'password' => getenv('DB_PASSWORD'),
                'dbname' => getenv('DB_NAME'),
                'charset' => 'utf8',
                'driverOptions' => [
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                ],
            ],
        ],
        'ormMappingsPath' => [
            __DIR__ . '/../../src/Infrastructure/DoctrineMappings',
        ],
        'cache' => ApcuCache::class,
    ],
];
