<?php

require_once __DIR__ . '/../vendor/autoload.php';

(new \Framework\Kernel())->execute(require_once __DIR__ . '/../bootstrap/web.php');
