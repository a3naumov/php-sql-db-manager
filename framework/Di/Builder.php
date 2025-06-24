<?php

declare(strict_types=1);

namespace Framework\Di;

use Framework\Core\Di\BuilderInterface;
use Framework\Core\File\FileManagerInterface;

class Builder implements BuilderInterface
{
    /** TODO: Change this with configurable path */
    private const string DI_DIR = __DIR__ . '/../../generated/di';

    /** TODO: Change this with configurable applications */
    private const array APPLICATIONS = [
        \App\TempApplication::class,
        \Framework\Application\WebApplication::class,
    ];

    public function __construct(
        private readonly FileManagerInterface $fileManager,
    ) {
    }

    public function build(): void
    {
        $this->fileManager->deleteDirectory(path: self::DI_DIR);
        $this->fileManager->createDirectory(path: self::DI_DIR);

        foreach (self::APPLICATIONS as $application) {
            $this->createClassWithInterceptorSuffix($application);
        }
    }

    private function createClassWithInterceptorSuffix(string $className): string
    {
        $reflection = new \ReflectionClass($className);

        $classNameWithSuffix = $reflection->getShortName() . 'Interceptor';

        $namespace = $reflection->getNamespaceName();

        $filePath = self::DI_DIR . '/' . str_replace('\\', '/', $namespace) . '/' . $classNameWithSuffix . '.php';

        $dependencies = [];

        foreach ($reflection->getConstructor()?->getParameters() ?? [] as $parameter) {
            $dependencyClass = $parameter->getType()?->getName();

            if ($dependencyClass && class_exists($dependencyClass)) {
                $dependencies[] = $this->createClassWithInterceptorSuffix($dependencyClass);
            }
        }

        $classDependencies = count($dependencies) > 0
            ? implode(
                "\n            ",
                array_map(
                    static fn(string $dependency) => "(new $dependency)(),",
                    $dependencies,
                ),
            )
            : '';

        $this->fileManager->createFile(
            path: $filePath,
            content: <<<PHP
<?php

namespace $namespace;

class $classNameWithSuffix
{
    public function __invoke(): \\$className
    {
        return new \\$className(
            $classDependencies
        );
    }
}
PHP
);

        return '\\' . $namespace . '\\' . $classNameWithSuffix;
    }
}
