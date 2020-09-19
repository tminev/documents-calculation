<?php

/**
 * @see       https://github.com/mezzio/mezzio-tooling for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-tooling/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-tooling/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Mezzio\Tooling\Factory;

use RuntimeException;

class UnidentifiedTypeException extends RuntimeException
{
    public static function forArgument(string $argument) : self
    {
        return new self(sprintf(
            'Cannot identify type for constructor argument "%s"; '
            . 'no type hint, or non-class/interface type hint',
            $argument
        ));
    }
}
