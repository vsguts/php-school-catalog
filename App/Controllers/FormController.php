<?php

namespace App\Controllers;

use App\Database\Query;
use App\Logger;
use App\Views\RedirectView;
use App\Views\TemplateView;

class FormController
{
    /**
     * @param array $params
     * @return TemplateView
     * @throws \Exception
     */
    public function index($params = [])
    {
        $query = new Query;
        $forms = $query->getList("SELECT * FROM forms");

        if (empty($forms)) {
            (new Logger())->log('ERROR', 'Forms list is empty');
            throw new \Exception('Forms list is empty');
        }

        return new TemplateView('form_index', [
            'title' => 'My awesome page',
            'forms' => $forms
        ]);
    }

    /**
     * @param array $params
     * @return TemplateView
     * @throws \Exception
     */
    public function view($params = [])
    {
        $query = new Query();
        $form = $query->getRow(
            "SELECT * FROM forms WHERE id = ?",
            [$params['id']]
        );

        if (empty($form)) {
            (new Logger())->log('ERROR', "Form with id = ${params['id']} doesn't exists");
            throw new \Exception("Form with id = ${params['id']} doesn't exists");
        }

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
}
