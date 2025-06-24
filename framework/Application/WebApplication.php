<?php

declare(strict_types=1);

namespace Framework\Application;

use Framework\Core\Application\ApplicationInterface;

class WebApplication implements ApplicationInterface
{
    public function process(): string
    {
        return '';
    }
}
