<?php

namespace App\Controllers;

class FormController
{
    public function index($params = [])
    {
        return 'Controller Index';
    }

    public function view($params = [])
    {
        p($params);

        return 'Controller View';

    }
}
