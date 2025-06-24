<?php

declare(strict_types=1);

namespace Framework\Core\View;

interface PageInterface
{
    public function render(): string;

    public function addBlock(BlockInterface $block): static;
}
