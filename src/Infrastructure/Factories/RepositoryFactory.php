<?php

namespace Infrastructure\Factories;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;

/**
 * RepositoryFactory
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class RepositoryFactory implements AbstractFactoryInterface
{
    protected $interfaceEntityMap = [

    ];

    /**
     * Creates repository by the given interface name
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  array|null $options
     *
     * @return ObjectRepository|EntityRepository The repository class
     *
     * @throws ServiceNotFoundException if unable to resolve the service
     * @throws ServiceNotCreatedException if an exception is raised when creating a service
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);

        return $entityManager->getRepository($this->interfaceEntityMap[$requestedName]);
    }

    /**
     * @inheritdoc
     */
    public function canCreate(ContainerInterface $container, $requestedName): bool
    {
        return array_key_exists($requestedName, $this->interfaceEntityMap);
    }
}
