<?php

declare(strict_types=1);

namespace Framework\Core\Config;

interface ConfigProviderInterface
{
    public function getConfig(string $name): string;
}
