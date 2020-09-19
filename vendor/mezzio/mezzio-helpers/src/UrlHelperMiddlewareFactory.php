<?php

/**
 * @see       https://github.com/mezzio/mezzio-helpers for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-helpers/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-helpers/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Mezzio\Helper;

use Psr\Container\ContainerInterface;

use function sprintf;

class UrlHelperMiddlewareFactory
{
    /** @var string */
    private $urlHelperServiceName;

    /**
     * Allow serialization
     */
    public static function __set_state(array $data) : self
    {
        return new self(
            $data['urlHelperServiceName'] ?? UrlHelper::class
        );
    }

    /**
     * Allow varying behavior based on URL helper service name.
     */
    public function __construct(string $urlHelperServiceName = UrlHelper::class)
    {
        $this->urlHelperServiceName = $urlHelperServiceName;
    }

    /**
     * Create and return a UrlHelperMiddleware instance.
     *
     * @throws Exception\MissingHelperException if the UrlHelper service is
     *     missing
     */
    public function __invoke(ContainerInterface $container) : UrlHelperMiddleware
    {
        if (! $container->has($this->urlHelperServiceName)) {
            throw new Exception\MissingHelperException(sprintf(
                '%s requires a %s service at instantiation; none found',
                UrlHelperMiddleware::class,
                $this->urlHelperServiceName
            ));
        }

        return new UrlHelperMiddleware($container->get($this->urlHelperServiceName));
    }
}
