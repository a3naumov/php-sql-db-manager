<?php

declare(strict_types=1);

namespace Framework\Core\Config;

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
