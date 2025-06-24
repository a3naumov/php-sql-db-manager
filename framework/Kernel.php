<?php

declare(strict_types=1);

namespace Framework;

use Framework\Core\Application\ApplicationInterface;
use Framework\Core\KernelInterface;

class Kernel implements KernelInterface
{
    public const int EXIT_SUCCESS = 0;
    public const int EXIT_FAILURE = 1;

    public function execute(ApplicationInterface $application): never
    {
        try {
            echo $application->process();
        } catch (\Throwable $e) {
            echo 'Error: ' . $e->getMessage();

            exit(self::EXIT_FAILURE);
        }

        exit(self::EXIT_SUCCESS);
    }
}
