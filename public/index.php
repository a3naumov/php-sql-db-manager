<?php

use App\Web\Controller\HomepageController;
use Framework\Di\Container;

require_once __DIR__ . '/../vendor/autoload.php';

$definitions = require_once __DIR__ . '/../var/di-map.php';
$container = new Container($definitions);

$homePageController = $container->get(HomepageController::class);

echo $homePageController->index()->getContent();
