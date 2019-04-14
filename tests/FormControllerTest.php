<?php
declare(strict_types=1);

use App\Views\TemplateView;
use PHPUnit\Framework\TestCase;
use App\Controllers\FormController;

class FormControllerTest extends TestCase
{
    public function testIndex()
    {
        $forms = [];
        $templateView = new TemplateView('form_index', [
            'title' => 'My awesome page',
            'forms' => $forms
        ]);
    }
}
