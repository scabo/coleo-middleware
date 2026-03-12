<?php

namespace Coleo\Middleware;

use Psr\Http\Server\MiddlewareInterface;

interface MiddlewareFactoryInterface
{
    public function create($name): MiddlewareInterface;
}
