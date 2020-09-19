<?php

/**
 * @see       https://github.com/mezzio/mezzio for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Mezzio\Middleware;

use Mezzio\Exception\InvalidMiddlewareException;
use Mezzio\MiddlewareContainer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LazyLoadingMiddleware implements MiddlewareInterface
{
    /**
     * @var MiddlewareContainer
     */
    private $container;

    /**
     * @var string
     */
    private $middlewareName;

    public function __construct(
        MiddlewareContainer $container,
        string $middlewareName
    ) {
        $this->container = $container;
        $this->middlewareName = $middlewareName;
    }

    /**
     * @throws InvalidMiddlewareException for invalid middleware types pulled
     *     from the container.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $middleware = $this->container->get($this->middlewareName);
        return $middleware->process($request, $handler);
    }
}
