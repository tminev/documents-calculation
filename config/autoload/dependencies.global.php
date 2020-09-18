<?php

use Http\Factories as HttpFactories;
use Http\Middlewares\CorsMiddleware;
use Infrastructure\Factories as InfrastructureFactories;
use Infrastructure\Services;
use Infrastructure\Validators\IsArray;
use League\Fractal\Manager;
use Mezzio\Helper;
use Mezzio\Middleware\ErrorResponseGenerator;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
            Helper\BodyParams\BodyParamsMiddleware::class => Helper\BodyParams\BodyParamsMiddleware::class,
        ],
        'abstract_factories' => [
            InfrastructureFactories\DynamicFactory::class,
            InfrastructureFactories\RepositoryFactory::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Helper\ServerUrlMiddleware::class => Helper\ServerUrlMiddlewareFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            Helper\UrlHelperMiddleware::class => Helper\UrlHelperMiddlewareFactory::class,

            ErrorResponseGenerator::class => HttpFactories\ErrorResponseGeneratorFactory::class,
            Manager::class => InfrastructureFactories\FractalManagerFactory::class,
            Services\Logger::class => InfrastructureFactories\LoggerFactory::class,
            Services\TransactionManager::class => InfrastructureFactories\DoctrineTransactionManagerFactory::class,
            IsArray::class => InfrastructureFactories\IsArrayFactory::class,
            CorsMiddleware::class => HttpFactories\CorsMiddlewareFactory::class,
        ],
    ],
];
