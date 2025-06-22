<?php

declare(strict_types=1);

namespace Framework\View;

interface BlockRendererInterface
{
    public function render(BlockInterface $block): string;
}
