<?php

declare(strict_types=1);

namespace Framework\Core\File;

interface FileManagerInterface
{
    public function deleteDirectory(string $path): void;

    public function createDirectory(string $path): void;

    public function createFile(string $path, string $content = ''): void;
}
