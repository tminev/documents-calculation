<?php

namespace Infrastructure\Validators;

use Laminas\Validator\AbstractValidator;
use Laminas\Validator\Exception;
use Traversable;

/**
 * Validation for array
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class IsArray extends AbstractValidator
{
    const INVALID = 'invalidArray';
    const NOT_INT = 'notArrayOfIntegers';

    const ONLY_INT = 1;

    /**
     * @var array
     */
    protected $messageTemplates = [
        self::INVALID => "Invalid value given. Array expected",
        self::NOT_INT => "The array does not appear to be an valid array of integers",
    ];

    /**
     * @var array
     */
    protected $options = [
        'content' => null,
    ];

    /**
     * Constructor for the array validator
     *
     * @param  array|Traversable $options
     *
     * @throws Exception\ExtensionNotLoadedException if ext/intl is not present
     */
    public function __construct($options = [])
    {
        parent::__construct($options);
    }

    /**
     * Returns true if and only if $value is a valid integer
     *
     * @param  string|int $value
     *
     * @return bool
     *
     * @throws Exception\InvalidArgumentException
     */
    public function isValid($value)
    {
        if (!is_array($value)) {
            $this->error(self::INVALID);

            return false;
        }

        if ($this->options['content'] === self::ONLY_INT
            && $value !== array_filter($value, 'is_numeric')
        ) {
            $this->error(self::NOT_INT);

            return false;
        }

        return true;
    }
}
