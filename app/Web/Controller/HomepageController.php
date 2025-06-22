<?php

declare(strict_types=1);

namespace App\Web\Controller;

use Framework\Core\ResultInterface;

class HomepageController
{
    private string $viewsDirectory = __DIR__ . '/../../../views';

    public function index(): ResultInterface
    {
        $blockFactory = new \Framework\View\BlockFactory();

        return new \Framework\View\Page(
            'Homepage',
            $blockFactory->create(
                template: $this->viewsDirectory . '/base.phtml',
                data: [
                    'title' => 'Homepage',
                ],
                children: [
                    $blockFactory->create(
                        template: $this->viewsDirectory . '/page-title.phtml',
                        children: [
                            $blockFactory->create(
                                template: $this->viewsDirectory . '/page-description.phtml',
                            ),
                        ],
                    ),
                ],
            ),
        );
    }
}
