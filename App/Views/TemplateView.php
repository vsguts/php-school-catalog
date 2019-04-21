<?php

namespace App\Views;

use App\Logger\Logger;

class TemplateView implements ViewInterface
{
    protected $template;

    protected $data = [];

    public function __construct(string $template, array $data = [])
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function render()
    {
        try {
            extract($this->data);

            $path = __DIR__ . '/../../views/' . $this->template . '.php';
            if (!file_exists($path)) {
                throw new \Exception('View file does not exists');
            }

            ob_start();
            require __DIR__ . '/../../views/' . $this->template . '.php';
            $content = ob_get_clean();

            require __DIR__ . '/../../views/layout.php';
        } catch (\Exception $e) {
            $log = new Logger();
            $log->log($e->getMessage());
        }
    }
}
