<?php

declare(strict_types=1);

namespace Framework\Core\View;

interface BlockInterface
{
    public function getTemplate(): string;

    public function getData(): array;

    /**
     * @return BlockInterface[]
     */
    public function getChildren(): array;

    public function addChild(BlockInterface $child): static;
}
