<?php

declare(strict_types=1);

namespace Framework\Di;

use Framework\Di\Exception\NoDefinitionFoundException;

interface ContainerInterface
{
    /**
     * @throws NoDefinitionFoundException
     */
    public function get(string $class): object;
}
