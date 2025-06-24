<?php

declare(strict_types=1);

namespace Framework\Core;

use Framework\Core\Application\ApplicationInterface;

interface KernelInterface
{
    public function execute(ApplicationInterface $application): never;
}
