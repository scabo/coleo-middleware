<?php

declare(strict_types=1);

namespace Coleo\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MiddlewareDispatcher implements RequestHandlerInterface, MiddlewareDispatcherInterface
{
    private int $index = 0;
    private array $middlewares = [];
    private ?RequestHandlerInterface $fallbackHandler = null;


    public function setMiddlewares(array $middlewares)
    {
        $this->middlewares = $middlewares;
        return $this;
    }

    public function setFallbackHandler(RequestHandlerInterface $handler)
    {
        $this->fallbackHandler = $handler;
        return $this;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!isset($this->middlewares[$this->index])) {
            return $this->fallbackHandler->handle($request);
        }

        $middleware = $this->middlewares[$this->index];
        if (!($middleware instanceof MiddlewareInterface)) {
            throw new \Exception("Passed value should be instance of MiddlewareInterface", 1);
        }
        $this->index++;

        return $middleware->process($request, $this);
    }
}
