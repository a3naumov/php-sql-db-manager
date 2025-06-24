<?php

declare(strict_types=1);

namespace Framework\Di;

use Framework\Core\Di\ContainerInterface;

class Container implements ContainerInterface
{
    private array $definitions;
    private array $instances = [];

    public function __construct(array $definitions)
    {
        $this->definitions = $definitions;
    }

    public function get(string $id): object
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        if (!isset($this->definitions[$id])) {
            throw new \Exception("No definition found for class: $id");
        }

        $dependencies = [];
        foreach ($this->definitions[$id] as $dep) {
            $dependencies[] = $this->get($dep);
        }

        $instance = new $id(...$dependencies);
        $this->instances[$id] = $instance;

        return $instance;
    }

    public function has(string $id): bool
    {
        return isset($this->definitions[$id]) || isset($this->instances[$id]);
    }
}
