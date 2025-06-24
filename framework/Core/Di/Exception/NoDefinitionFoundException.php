<?php

declare(strict_types=1);

namespace Framework\Core\Di\Exception;

class NoDefinitionFoundException extends \Exception
{
    public function __construct(string $class)
    {
        parent::__construct('No definition found for class: ' . $class);
    }
}
