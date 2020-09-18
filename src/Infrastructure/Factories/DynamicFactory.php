<?php

namespace Infrastructure\Factories;

use Exception;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;
use ReflectionClass;
use Throwable;

/**
 * Class DynamicFactory
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class DynamicFactory implements AbstractFactoryInterface
{
    /**
     * Creates an instance of the requested class name resolving all of listed
     * in the constructor dependencies
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return object
     *
     * @throws Exception
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an  exception is raised when
     * creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        try {
            $class = new ReflectionClass($requestedName);

            $constructor = $class->getConstructor();

            if (is_null($constructor)) {
                return new $requestedName();
            }

            $parameters = $constructor->getParameters();

            $dependencies = [];

            foreach ($parameters as $parameter) {
                if ($parameter->getName() === 'config') {
                    $dependencies[] = $container->get('config');
                } else {
                    if ($parameter->getClass() === null) {
                        throw new Exception('Invalid class');
                    }

                    $className = $parameter->getClass()->getName();

                    if ($container->has($className)) {
                        $dependency = $container->get($className);
                    } else {
                        $dependency = new $className();
                    }

                    $dependencies[] = $dependency;
                    $dependency = null;
                }
            }

            return new $requestedName(...$dependencies);
        } catch (Throwable $t) {
            $message = sprintf(
                'Unable to resolve %s.Possible problem: "%s", or maybe you should provide custom factory for it.',
                $requestedName,
                $t->getMessage()
            );

            throw new Exception($message);
        }
    }

    /**
     * @inheritdoc
     */
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return class_exists($requestedName);
    }
}
