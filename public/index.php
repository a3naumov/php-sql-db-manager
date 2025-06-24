<?php

require_once __DIR__ . '/../vendor/autoload.php';

exit((new \Framework\Kernel())->execute(require_once __DIR__ . '/../bootstrap/web.php'));
