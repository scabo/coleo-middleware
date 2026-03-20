<?php

declare(strict_types=1);

namespace Coleo\Middleware;

use Psr\Http\Server\MiddlewareInterface;

interface MiddlewareFactoryInterface
{
    public function create(string $name): MiddlewareInterface;
}
