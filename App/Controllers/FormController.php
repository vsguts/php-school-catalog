<?php

namespace App\Controllers;

use App\Database\Query;
use App\Views\RedirectView;
use App\Views\TemplateView;
use App\Views\UpdateView;

class FormController
{
    public function index($params = [])
    {
        $query = new Query;
        $forms = $query->getList("SELECT * FROM forms");

        return new TemplateView('form_index', [
            'title' => 'My awesome page',
            'forms' => $forms
        ]);
    }

    public function view($params = [])
    {
        $query = new Query();
        $form = $query->getRow(
            "SELECT * FROM forms WHERE id = ?",
            [$params['id']]
        );

        return new TemplateView('form_view', [
            'form' => $form
        ]);
    }

    public function create($params, $post)
    {
        $query = new Query();
        // $query->execute(
        //     "INSERT INTO forms (title, content) VALUES (?, ?)",
        //     [$post['form']['title'], $post['form']['content']]
        // );

        $query->execute(
            "INSERT INTO forms (title, content) VALUES (:title, :content)",
            $post['form']
        );

        $id = $query->getLastInsertId();

        return new RedirectView('/forms/view?id=' . $id);
    }

    public function delete($params)
    {
        (new Query)->execute("DELETE FROM forms WHERE id = ?", [$params['id']]);
        return new RedirectView('/forms');
    }

    public function edit($params)
    {
        $query = new Query();
        $form = $query->getRow(
            "SELECT * FROM forms WHERE id = ?",
            [$params['id']]
        );

        return new TemplateView(
            'update_view', [
                'title' =>'Editing',
                'form' => $form
        ]);
    }

    public function update($params, $post)
    {
        $post['form']['id'] = $params['id'];

        $query = new Query();
        $query->execute(
            "UPDATE forms SET title = :title, content = :content WHERE id = :id",
            $post['form']
        );

        $id = $params['id'];

        return new RedirectView('/forms/view?id=' . $id);
    }
}
