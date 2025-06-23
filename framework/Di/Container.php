<?php

declare(strict_types=1);

namespace Framework\Di;

class Container implements ContainerInterface
{
    private array $definitions;
    private array $instances = [];

    public function __construct(array $definitions)
    {
        $this->definitions = $definitions;
    }

    public function get(string $class): object
    {
        if (isset($this->instances[$class])) {
            return $this->instances[$class];
        }

        if (!isset($this->definitions[$class])) {
            throw new \Exception("No definition found for class: $class");
        }

        $dependencies = [];
        foreach ($this->definitions[$class] as $dep) {
            $dependencies[] = $this->get($dep);
        }

        $instance = new $class(...$dependencies);
        $this->instances[$class] = $instance;

        return $instance;
    }
}
