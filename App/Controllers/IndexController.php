<?php

namespace App\Controllers;

use App\Views\StringView;

class IndexController
{
    public function index()
    {
        return new StringView('I am action index');
    }
}
