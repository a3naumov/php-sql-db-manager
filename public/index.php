<?php

require_once __DIR__ . '/../vendor/autoload.php';

class Container
{
    private array $definitions;
    private array $instances = [];

    public function __construct(array $definitions)
    {
        $this->definitions = $definitions;
    }

    public function get(string $class): object
    {
        if (isset($this->instances[$class])) {
            return $this->instances[$class];
        }

        if (!isset($this->definitions[$class])) {
            throw new \Exception("No definition found for class: $class");
        }

        $dependencies = [];
        foreach ($this->definitions[$class] as $dep) {
            $dependencies[] = $this->get($dep);
        }

        $instance = new $class(...$dependencies);
        $this->instances[$class] = $instance;

        return $instance;
    }
}

$definitions = require_once __DIR__ . '/../var/di-map.php';
$container = new Container($definitions);

$homePageController = $container->get(\App\Web\Controller\HomepageController::class);
//$homePageController = new \App\Web\Controller\HomepageController();

echo $homePageController->index()->getContent();
