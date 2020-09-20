<?php

namespace Stubs;

use Domain\AbstractEntity;
use Domain\EntityInterface;
use DateTime;

/**
 * Class EntityStub
 */
class EntityStub extends AbstractEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $property;

    /**
     * @var DateTime
     */
    private $dateProperty;

    /**
     * @inheritdoc
     */
    public function fromArray(array $data): EntityInterface
    {
        if (array_key_exists('property', $data)) {
            $this->setProperty($data['property']);
        }

        if (array_key_exists('dateProperty', $data)) {
            $this->setDateProperty(new DateTime($data['dateProperty']));
        }

        return $this;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set property.
     *
     * @param string $property
     *
     * @return EntityStub
     */
    public function setProperty($property)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Get property.
     *
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set dateProperty.
     *
     * @param string $dateProperty
     *
     * @return EntityStub
     */
    public function setDateProperty($dateProperty)
    {
        $this->dateProperty = $dateProperty;

        return $this;
    }

    /**
     * Get dateProperty.
     *
     * @return DateTime
     */
    public function getDateProperty()
    {
        return $this->dateProperty;
    }
}
