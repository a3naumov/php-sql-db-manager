<?php

declare(strict_types=1);

namespace Framework\Config;

use Framework\Core\Config\ConfigProviderInterface;

class ConfigProvider implements ConfigProviderInterface
{
    public function __construct(
//        private string $configDir,
    ) {
    }

    public function getConfig(string $name): string
    {
        return '';
    }
}
