<?php

declare(strict_types=1);

namespace Coleo\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

interface MiddlewareDispatcherInterface
{
    public function setMiddlewares(array $middlewares);
    public function setFallbackHandler(RequestHandlerInterface $handler);
    public function handle(ServerRequestInterface $request);
}
