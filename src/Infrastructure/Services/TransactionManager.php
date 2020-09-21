<?php

namespace Infrastructure\Services;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TransactionManager
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class TransactionManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * TransactionManager constructor
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Begin transaction
     */
    public function begin(): void
    {
        $this->entityManager->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public function commit(): void
    {
        $this->entityManager->commit();
    }

    /**
     * Rollback transaction
     */
    public function rollback(): void
    {
        $this->entityManager->rollback();
    }
}
