<?php

declare(strict_types=1);

namespace Framework\View;

class BlockRenderer implements BlockRendererInterface
{
    public function render(BlockInterface $block): string
    {
        $data = $block->getData();
        $childrenContent = array_map(fn (BlockInterface $child) => $this->render($child), $block->getChildren());
        $data['children'] = implode('', $childrenContent);

        if ($block->getTemplate()) {
            return $this->renderTemplate($block->getTemplate(), $data);
        }

        return '';
    }

    private function renderTemplate(string $template, array $data): string
    {
        extract($data);
        ob_start();
        require_once $template;

        return ob_get_clean();
    }
}
