<?php

namespace Infrastructure\Collections;

use Domain\PaginatedCollectionInterface;

/**
 * Class Collection
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class Collection implements CollectionInterface, PaginatedCollectionInterface
{
    /**
     * All values stored in the current collection
     *
     * @var array
     */
    private $values;

    /**
     * Stores the total count of the values
     *
     * @var int
     */
    private $totalCount;

    /**
     * Collection constructor.
     *
     * @param array $values
     * @param int $totalCount
     */
    public function __construct(array $values, int $totalCount)
    {
        $this->setValues($values);
        $this->setTotalCount($totalCount);
    }

    /**
     * @inheritDoc
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Sets the values used in the current result set
     *
     * @param array $values
     */
    public function setValues(array $values)
    {
        $this->values = $values;
    }

    /**
     * @inheritDoc
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * Sets the totalCount of the result set
     *
     * @param int $totalCount
     */
    public function setTotalCount(int $totalCount)
    {
        $this->totalCount = $totalCount;
    }
}
