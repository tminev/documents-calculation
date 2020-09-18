<?php

namespace Application\Exceptions;

use Exception;

/**
 * Class ValidationFailedException
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class ValidationFailedException extends Exception
{
    /**
     * @var array
     */
    private $errors;

    /**
     * ValidationFailedException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     * @param array $errors
     */
    public function __construct(
        string $message = '',
        int $code = 0,
        Exception $previous = null,
        array $errors = []
    ) {
        if (!$message) {
            $message = "Validation Failed";
        }

        $this->errors = $errors;

        parent::__construct($message, $code, $previous);
    }

    /**
     * Returns the errors associated with the exception
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
