<?php

declare(strict_types=1);

namespace Framework\Core\Di;

use Framework\Core\Di\Exception\NoDefinitionFoundException;

interface ContainerInterface
{
    /**
     * @throws NoDefinitionFoundException
     */
    public function get(string $class): object;
}
