<?php

declare(strict_types=1);

namespace Framework\File;

use Framework\Core\File\FileManagerInterface;

class FileManager implements FileManagerInterface
{
    public function deleteDirectory(string $path): void
    {
        if (is_dir($path)) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST,
            );

            foreach ($files as $file) {
                if ($file->isDir()) {
                    rmdir($file->getPathname());
                } else {
                    unlink($file->getPathname());
                }
            }

            rmdir($path);
        }
    }

    public function createDirectory(string $path): void
    {
        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true) && !is_dir($path)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
        }
    }

    public function createFile(string $path, string $content = ''): void
    {
        $directory = dirname($path);

        if (!is_dir($directory)) {
            $this->createDirectory($directory);
        }

        if (file_exists($path)) {
            unlink($path);
        }

        $fileHandle = fopen($path, 'w');

        if ($fileHandle === false) {
            throw new \RuntimeException(sprintf('File "%s" could not be created', $path));
        }

        fwrite($fileHandle, $content);
        fclose($fileHandle);
    }
}
