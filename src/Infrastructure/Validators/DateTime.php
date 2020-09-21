<?php

namespace Infrastructure\Validators;

use DateTime as PhpDateTime;
use Laminas\I18n\Validator\DateTime as ZendDateTime;

/**
 * Validation for datetime
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class DateTime extends ZendDateTime
{
    /**
     * @inheritdoc
     */
    public function isValid($value)
    {
        if (!is_string($value)) {
            $this->error(self::INVALID);

            return false;
        }

        $this->setValue($value);

        if (PhpDateTime::createFromFormat($this->pattern, $value) === false) {
            $this->error(self::INVALID_DATETIME);
            $this->invalidateFormatter = true;

            return false;
        }

        return true;
    }
}
