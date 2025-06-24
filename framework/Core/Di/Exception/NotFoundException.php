<?php

declare(strict_types=1);

namespace Framework\Core\Di\Exception;

use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends \Exception implements NotFoundExceptionInterface
{
    public function __construct(string $id)
    {
        parent::__construct("No entry found for identifier: $id");
    }
}
