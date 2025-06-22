<?php

declare(strict_types=1);

namespace Framework\View;

class Block implements BlockInterface
{
    /**
     * @param BlockInterface[] $children
     */
    public function __construct(
        protected string $template = '',
        protected array $data = [],
        protected array $children = [],
    ) {
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function addChild(BlockInterface $child): static
    {
        $this->children[] = $child;

        return $this;
    }
}
