<?php

namespace App\Views;

class TemplateView
{
    const VIEWS_PATH = __DIR__ . '/../../views/';
    const LAYOUT_NAME = 'layout';

    public function __construct($viewName, $params)
    {
          $content = $this->getContent($viewName, $params);
//          $params['content'] = $content; // is it optimal?
          $this->display($viewName, $params, $content);
    }

    protected function getContent($viewName, $params)
    {
        extract($params);
        ob_start();
        require static::VIEWS_PATH . $viewName . '.php';
        return ob_get_flush();
    }

    /**
     * @param $viewName
     * @param $params
     * @param $content
     */
    protected function display($viewName, $params, $content)
    {
        extract($params);
        ob_start();
        require static::VIEWS_PATH . static::LAYOUT_NAME . '.php';
        ob_end_flush();
    }
}
