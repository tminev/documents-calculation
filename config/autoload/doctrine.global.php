<?php

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
];
