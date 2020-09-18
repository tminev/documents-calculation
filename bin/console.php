<?php

declare(strict_types=1);

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use Symfony\Component\Console\Application;

/**
 * Self-called anonymous function that creates its own scope and keep the global namespace clean.
 */
(function () {
    /** @var \Psr\Container\ContainerInterface $container */
    $container = require 'config/container.php';

    /** @var Symfony\Component\Console\Application; $app */
    $app = new Application('Application console');
    $commands = $container->get('config')['console']['commands'];

    foreach ($commands as $command) {
        $app->add($container->get($command));
    }

    $app->run();
})();
