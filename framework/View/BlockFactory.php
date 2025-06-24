<?php

declare(strict_types=1);

namespace Framework\View;

use Framework\Core\Di\Attribute\Bind;
use Framework\Core\View\BlockFactoryInterface;
use Framework\Core\View\BlockInterface;

#[Bind(id: BlockFactoryInterface::class)]
class BlockFactory implements BlockFactoryInterface
{
    public function create(string $template, array $data = [], array $children = []): BlockInterface
    {
        return new Block($template, $data, $children);
    }
}
