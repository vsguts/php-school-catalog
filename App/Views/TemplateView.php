<?php

namespace App\Views;

class TemplateView
{
    /**
     * @var null|string
     */
    private $viewName;
    /**
     * @var array
     */
    private $forms = [];

    /**
     * TemplateView constructor.
     * @param string $viewName
     * @param array $forms
     */
    public function __construct(string $viewName, array $forms = [])
    {
        $this->viewName = $viewName;

        $this->forms = $forms;

        $this->render();
    }

    protected function render()
    {
        $filePath = __DIR__ . '/../../views/' . $this->viewName . '.php';
        if (!file_exists($filePath)) {
            throw new \RuntimeException(sprintf('View %s does not exists', $filePath));
        }
        extract($this->forms);
        ob_start();
        include_once __DIR__ . '/../../views/' . $this->viewName . '.php';
        $content = ob_get_clean();

        include_once __DIR__ . '/../../views/layout.php';
    }
}
