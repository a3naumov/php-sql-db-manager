<?php

interface BlockInterface
{
    public function render(): string;

    public function addChild(BlockInterface $child): static;
}

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

interface PageInterface
{
    public function render(): string;
}

class Page implements PageInterface
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
        return $this->getBaseBlock()->render();
    }

    private function getBaseBlock(): BlockInterface
    {
        $blockFactory = new BlockFactory();
        $baseBlock = $blockFactory->create(
            template: __DIR__ . '/views/base.phtml',
            data: [
                'title' => $this->title,
            ]
        );

        foreach ($this->blocks as $block) {
            $baseBlock->addChild($block);
        }

        return $baseBlock;
    }
}

interface BlockFactoryInterface
{
    /**
     * @param BlockInterface[] $children
     */
    public function create(string $template, array $data = [], array $children = []): BlockInterface;
}

class BlockFactory implements BlockFactoryInterface
{
    public function create(string $template, array $data = [], array $children = []): BlockInterface
    {
        return new Block($template, $data, $children);
    }
}

$blockFactory = new BlockFactory();

$page = new Page(
    'Homepage',
    $blockFactory->create(
        template: __DIR__ . '/views/page-title.phtml',
        children: [
            $blockFactory->create(
                template: __DIR__ . '/views/page-description.phtml',
            ),
        ],
    ),
);

echo $page->render();
