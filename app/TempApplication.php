<?php

declare(strict_types=1);

namespace App;

use App\Web\Controller\HomepageController;
use Framework\Core\Application\ApplicationInterface;
use Framework\Core\Di\Attribute\Tag;

#[Tag(id: ApplicationInterface::class)]
class TempApplication implements ApplicationInterface
{
    public function __construct(
        private readonly HomepageController $homepageController,
    ) {
    }

    public function process(): string
    {
        return $this->homepageController->index()->getContent();
    }
}
