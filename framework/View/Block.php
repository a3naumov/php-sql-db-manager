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

    public function render(): string
    {
        $data = $this->data;
        $childrenContent = array_map(static fn(BlockInterface $child) => $child->render(), $this->children);
        $data['children'] = implode('', $childrenContent);

        if ($this->template) {
            return $this->renderTemplate($this->template, $data);
        }

        return '';
    }

    public function addChild(BlockInterface $child): static
    {
        $this->children[] = $child;

        return $this;
    }

    private function renderTemplate(string $template, array $data = []): string
    {
        extract($data);
        ob_start();
        require_once $template;
        return ob_get_clean();
    }
}
