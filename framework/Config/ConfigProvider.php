<?php

declare(strict_types=1);

namespace Framework\Config;

use Framework\Core\Config\ConfigProviderInterface;
use Framework\Core\Di\Attribute\Bind;

#[Bind(id: ConfigProviderInterface::class)]
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
