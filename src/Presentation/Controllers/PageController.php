<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;

use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;

class PageController
{
    private ViewRenderer $_viewRenderer;

    public function __construct(ViewRenderer $viewRenderer)
    {
        $this->_viewRenderer = $viewRenderer;
    }

    public function about(): void
    {
        $this->_viewRenderer->render('pages/about', [
            'titulo' => 'Acerca de iDiscuss'
        ]);
    }
}