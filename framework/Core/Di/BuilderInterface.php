<?php

declare(strict_types=1);

namespace Framework\Core\Di;

interface BuilderInterface
{
    public function build(): void;
}
