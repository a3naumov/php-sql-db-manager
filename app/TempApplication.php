<?php

declare(strict_types=1);

namespace App;

use App\Web\Controller\HomepageController;
use Framework\Core\Application\ApplicationInterface;

class TempApplication implements ApplicationInterface
{
    public function process(): string
    {
        return (new HomepageController())->index()->getContent();
    }
}
