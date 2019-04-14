<?php

namespace App\Controllers;

use App\Database\Query;
use App\Logger;
use App\Views\RedirectView;
use App\Views\TemplateView;

class FormController
{
    /** @var Query */
    private $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    public function index($params = [])
    {
        $forms = $this->query->getList("SELECT * FROM forms");

        return new TemplateView('form_index', [
            'title' => 'My awesome page',
            'forms' => $forms
        ]);
    }

    public function view($params = [])
    {
        $form = $this->query->getRow(
            "SELECT * FROM forms WHERE id = ?",
            [$params['id']]
        );

        if(empty($form)) {
            (new Logger())->log(sprintf('File not found. Id: %s', $params['id']), 'ERROR');
        }

        return new TemplateView('form_view', [
            'form' => $form
        ]);
    }

    public function create($params, $post)
    {
        $queryStr = "INSERT INTO forms (title, content) VALUES (:title, :content)";
        if ($post['form']['id']) {
            $queryStr = "UPDATE `forms` SET `title` = :title, `content` = :content WHERE `id` = :id";
        }

        $this->query->execute($queryStr, $post['form']);

        $id = $post['form']['id'] ? $post['form']['id'] : $this->query->getLastInsertId();

        return new RedirectView('/forms/view?id=' . $id);
    }

    public function delete($params)
    {
        $this->query->execute("DELETE FROM forms WHERE id = ?", [$params['id']]);

        return new RedirectView('/forms');
    }

    public function update($params)
    {
        $data = $this->query->getRow('SELECT title, content FROM forms WHERE id = ?', [$params['id']]);
        $data['button_title'] = 'Update';
        $data['id'] = $params['id'];

        return new TemplateView('form', [
            'data' => $data
        ]);
    }
}
