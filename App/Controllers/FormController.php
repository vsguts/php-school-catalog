<?php

namespace App\Controllers;

class FormController
{
    public function index($params = [])
    {
        echo 'Controller Index';
    }

    public function view($params = [])
    {
        echo 'Controller View';

        p($params);
    }
}
