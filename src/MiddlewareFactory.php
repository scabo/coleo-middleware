<?php

declare(strict_types=1);

namespace Coleo\Middleware;

use Psr\Http\Server\MiddlewareInterface;

class MiddlewareFactory implements MiddlewareFactoryInterface
{
    public function __construct(private string $namespace)
    {
    }

    public function create(string $name): MiddlewareInterface
    {
        $fullClassName = $this->namespace . '\\' . ucfirst($name);
        if (
            class_exists($fullClassName)
            && in_array(MiddlewareInterface::class, class_parents($fullClassName))
        ) {
            return new $fullClassName();
        } else {
            throw new \Exception("$fullClassName not found", 1);
        }
    }
}
