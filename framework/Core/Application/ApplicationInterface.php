<?php

declare(strict_types=1);

namespace Framework\Core\Application;

interface ApplicationInterface
{
    public function process(): string;
}
