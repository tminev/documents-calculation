<?php

namespace Infrastructure\Collections;

/**
 * Interface CollectionInterface
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
interface CollectionInterface
{
    /**
     * Returns all values stored in the collection
     *
     * @return array
     */
    public function getValues(): array;
}
