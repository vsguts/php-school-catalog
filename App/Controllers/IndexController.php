<?php

namespace App\Controllers;

use App\Views\TemplateView;

class IndexController
{
    public function index()
    {
        return new TemplateView('homepageView', [
            'title' => 'Home page!',
        ]);
    }
}
