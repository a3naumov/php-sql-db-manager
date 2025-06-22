<?php

declare(strict_types=1);

namespace Framework\View;

interface PageInterface
{
    public function render(): string;

    public function addBlock(BlockInterface $block): static;
}
