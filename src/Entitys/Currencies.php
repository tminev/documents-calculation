<?php

namespace Application\Entitys;

/**
 * Class Currencies
 */
class Currencies
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $value;

    **
    * Get contactName.
    *
    * @

    return string
    */

    public function getContactName(): string
    {
        return $this->contactName;
    }

   /**
    * Set contactName.
    *
    * @param string $contactName
    *
    * @return MessageQueue
    */
    public function setContactName(string $contactName): MessageQueue
    {
        $this->contactName = $contactName;

        return $this;
    }
}
