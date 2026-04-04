<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Presentation\Views;

use RuntimeException;

class ViewRenderer
{
    private string $_viewsPath;
    private string $_layoutName;

    public function __construct(string $viewsPath, string $layoutName = 'main')
    {
        $this->_viewsPath = rtrim($viewsPath, '/');
        $this->_layoutName = $layoutName;
    }

    public function render(string $viewName, array $data = []): void
    {
        $viewFile = $this->_viewsPath . '/' . $viewName . '.php';
        $layoutFile = $this->_viewsPath . '/layouts/' . $this->_layoutName . '.php';

        if (!file_exists($viewFile)) {
            throw new RuntimeException("La vista '{$viewFile}' no existe.");
        }

        if (!file_exists($layoutFile)) {
            throw new RuntimeException("El layout '{$layoutFile}' no existe.");
        }

        extract($data);

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layoutFile;
    }
}