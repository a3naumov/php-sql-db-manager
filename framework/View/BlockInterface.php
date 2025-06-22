<?php

declare(strict_types=1);

namespace Framework\View;

interface BlockInterface
{
    public function render(): string;

    public function addChild(BlockInterface $child): static;
}
