<?php

declare(strict_types=1);

namespace Framework\View;

use Framework\Core\View\BlockFactoryInterface;
use Framework\Core\View\BlockInterface;

class BlockFactory implements BlockFactoryInterface
{
    public function create(string $template, array $data = [], array $children = []): BlockInterface
    {
        return new Block($template, $data, $children);
    }
}
