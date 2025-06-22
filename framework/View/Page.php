<?php

declare(strict_types=1);

namespace Framework\View;

use Framework\Core\ResultInterface;

class Page implements PageInterface, ResultInterface
{
    /**
     * @var BlockInterface[]
     */
    private array $blocks;

    public function __construct(
        protected string $title,
        BlockInterface... $blocks,
    ) {
        $this->blocks = $blocks;
    }

    public function render(): string
    {
        return implode('', array_map(static fn (BlockInterface $block) => $block->render(), $this->blocks));
    }

    public function addBlock(BlockInterface $block): static
    {
        $this->blocks[] = $block;

        return $this;
    }

    public function getContent(): string
    {
        return $this->render();
    }
}
