<?php

declare(strict_types=1);

namespace Framework\Core\Di\Exception;

use Psr\Container\ContainerExceptionInterface;

class ContainerException extends \Exception implements ContainerExceptionInterface
{
}
