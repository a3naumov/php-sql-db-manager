<?php

declare(strict_types=1);

namespace Framework\Cli;

use Framework\Core\Cli\CommandInterface;
use Framework\Core\Di\Attribute\Tag;
use Framework\Core\Di\BuilderInterface;
use Framework\Core\Di\BuilderProvider;

#[Tag(id: CommandInterface::class)]
class DiCompileCommand implements CommandInterface
{
    private BuilderInterface $diBuilder;

    public function __construct(
        ?BuilderInterface $diBuilder = null,
    ) {
        if (null === $diBuilder) {
            $diBuilder = (new BuilderProvider())->getBuilder();
        }

        $this->diBuilder = $diBuilder;
    }

    public function getName(): string
    {
        return 'di-compile';
    }

    public function execute(): int
    {
        $this->diBuilder->build();

        return self::EXIT_SUCCESS;
    }
}
