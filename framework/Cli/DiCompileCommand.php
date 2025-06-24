<?php

declare(strict_types=1);

namespace Framework\Cli;

use Framework\Core\Cli\CommandInterface;

class DiCompileCommand implements CommandInterface
{
    public function getName(): string
    {
        return 'di-compile';
    }

    public function execute(): int
    {
        $classes = [
            \App\Web\Controller\HomepageController::class,
            \Framework\Config\ConfigProvider::class,
        ];

        $map = [];

        foreach  ($classes as $class) {
            $reflection = new \ReflectionClass($class);
            $constructor = $reflection->getConstructor();

            if (!$constructor) {
                $map[$class] = [];
                continue;
            }

            $dependencies = [];
            foreach($constructor->getParameters() as $parameter) {
                $type = $parameter->getType();
                if ($type && !$type->isBuiltin()) {
                    $dependencies[] = $type->getName();
                } else {
                    $dependencies[] = 'mixed';
                }
            }

            $map[$class] = $dependencies;
        }

        file_put_contents(
            __DIR__ . '/../../var/di-map.php',
            '<?php return ' . var_export($map, true) . ';'
        );

        return self::EXIT_SUCCESS;
    }
}
