<?php

declare(strict_types=1);

namespace Framework;

use Framework\Core\Application\ApplicationInterface;
use Framework\Core\KernelInterface;

class Kernel implements KernelInterface
{
    public const int EXIT_SUCCESS = 0;
    public const int EXIT_FAILURE = 1;

    public function execute(ApplicationInterface $application): int
    {
        try {
            echo $application->process();
        } catch (\Throwable $e) {
            echo 'Error: ' . $e->getMessage();

            return self::EXIT_FAILURE;
        }

        return self::EXIT_SUCCESS;
    }
}
