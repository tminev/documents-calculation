<?php

/**
 * @see       https://github.com/mezzio/mezzio-helpers for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-helpers/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-helpers/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Mezzio\Helper\Template;

use Mezzio\Router\RouteResult;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Inject the currently matched route into the template variable container.
 *
 * This middleware expects the TemplateVariableContainerMiddleware to precede
 * it in the middleware pipeline, or to have the TemplateVariableContainer
 * request attribute present. If neither is true, it will create a new
 * instance, and pass it into the request when invoking the handler.
 *
 * If it finds a RouteResult request attribute, it will inject the instance
 * under the name `route` in the template variable container; otherwise, a
 * `null` value is injected for that key.
 *
 * Templates rendered using the container can then access that value. It will
 * either be a Mezzio\Router\RouteResult instance, or empty.
 *
 * This middleware can replace the `UrlHelperMiddleware` in your pipeline.
 */
class RouteTemplateVariableMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $container = $request->getAttribute(
            TemplateVariableContainer::class,
            new TemplateVariableContainer()
        );

        $routeResult = $request->getAttribute(RouteResult::class, null);

        return $handler->handle($request->withAttribute(
            TemplateVariableContainer::class,
            $container->with('route', $routeResult)
        )->withAttribute(
            \Zend\Expressive\Helper\Template\TemplateVariableContainer::class,
            $container->with('route', $routeResult)
        ));
    }
}
