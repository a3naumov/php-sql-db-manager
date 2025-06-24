<?php

declare(strict_types=1);

namespace Framework\Core\Di\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Bind
{
    public function __construct(public string $id, public int $priority = 0)
    {
    }
}
