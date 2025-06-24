<?php

declare(strict_types=1);

namespace Framework\Core\Di;

use Framework\Di\Builder;
use Framework\File\FileManager;

/**
 * TODO: Think about a better place for this class.
 */
class BuilderProvider
{
    public function getBuilder(): BuilderInterface
    {
        return new Builder(
            fileManager: new FileManager(),
        );
    }
}
