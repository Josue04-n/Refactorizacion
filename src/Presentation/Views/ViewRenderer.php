<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Presentation\Views;

use RuntimeException;

class ViewRenderer
{
    private string $_viewsPath;
    private string $_layoutName;
    private array $_globalData = [];

    public function __construct(string $viewsPath, string $layoutName = 'main')
    {
        $this->_viewsPath = rtrim($viewsPath, '/');
        $this->_layoutName = $layoutName;
    }

    /**
     * Añade una variable que estará disponible en todas las vistas (incluyendo el Layout).
     *
     * @param string $key Nombre de la variable
     * @param mixed $value Valor de la variable
     */
    
    public function addGlobal(string $key, mixed $value): void
    {
        $this->_globalData[$key] = $value;
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

        extract($this->_globalData);

        extract($data);

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layoutFile;
    }
}