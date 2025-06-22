<?php

require_once __DIR__ . '/../vendor/autoload.php';

$homePageController = new \App\Web\Controller\HomepageController();

echo $homePageController->index()->getContent();
