<?php

declare(strict_types=1);

namespace Framework\Core\Cli;

interface CommandInterface
{
    public const int EXIT_SUCCESS = 0;
    public const int EXIT_FAILURE = 1;

    public function getName(): string;

    public function execute(): int;
}
