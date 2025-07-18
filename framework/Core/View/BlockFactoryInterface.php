<?php

declare(strict_types=1);

namespace Framework\Core\View;

interface BlockFactoryInterface
{
    /**
     * @param BlockInterface[] $children
     */
    public function create(string $template, array $data = [], array $children = []): BlockInterface;
}
