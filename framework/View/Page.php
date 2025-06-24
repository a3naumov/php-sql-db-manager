<?php

declare(strict_types=1);

namespace Framework\View;

use Framework\Core\ResultInterface;
use Framework\Core\View\BlockInterface;
use Framework\Core\View\BlockRendererInterface;
use Framework\Core\View\PageInterface;

class Page implements PageInterface, ResultInterface
{
    /**
     * @var BlockInterface[]
     */
    private array $blocks;

    private BlockRendererInterface $blockRenderer;

    public function __construct(
        protected string $title,
        BlockInterface... $blocks,
    ) {
        $this->blocks = $blocks;
    }

    public function render(): string
    {
        $blockRenderer = $this->getBlockRenderer();

        return implode('', array_map(
            static fn (BlockInterface $block) => $blockRenderer->render($block),
            $this->blocks,
        ));
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

    private function getBlockRenderer(): BlockRendererInterface
    {
        if (!isset($this->blockRenderer)) {
            $this->blockRenderer = new BlockRenderer();
        }

        return $this->blockRenderer;
    }
}
