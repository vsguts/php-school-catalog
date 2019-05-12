<?php

namespace App\Controllers;

use App\Database\Query;
use App\Views\RedirectView;
use App\Views\TemplateView;
use App\Logger;
use App\Views\ViewInterface;

class FormController
{
    public function index($params = []) : ViewInterface
    {
        $query = new Query;
        $forms = $query->getList("SELECT * FROM forms");

        Logger::log('Form list was displayed.', 'INFO');

        return new TemplateView('form_index', [
            'title' => 'My awesome page',
            'forms' => $forms
        ]);
    }

    public function view($params = []) : ViewInterface
    {
        $query = new Query();
        $form = $query->getRow(
            "SELECT * FROM forms WHERE id = ?",
            [$params['id']]
        );

        if ($form) {
            Logger::log("Form {$params['id']} was displayed.", 'INFO');
            return new TemplateView('form_view', [
                'title' => $form['title'],
                'form' => $form,
            ]);
        } else {
            Logger::log("Form not found. Id: {$params['id']}.", 'INFO');
            return new TemplateView('404_view', [
                'title' => 404,
                'id' => $params['id'],
            ]);
        }
    }

    public function create($params, $post)
    {
        if(!($post['form']['title'] && $post['form']['content'])) {
            Logger::log('Not enough data to create a new form.', 'WARN');
            echo 'Please, enter BOTH title and content to create a new form.';
            throw new \Exception('Not enough data to create a new form.');
        }

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
        Logger::log("Form {$id} was created.", 'INFO');

        return new RedirectView('/forms/view?id=' . $id);
    }

    public function delete($params) : ViewInterface
    {
        (new Query)->execute("DELETE FROM forms WHERE id = ?", [$params['id']]);

        Logger::log("Form {$params['id']} was deleted.", 'INFO');

        return new RedirectView('/forms');
    }

    public function edit($params) : ViewInterface
    {
        $query = new Query();
        $form = $query->getRow(
            "SELECT * FROM forms WHERE id = ?",
            [$params['id']]
        );

        if ($form) {
            Logger::log(
                "Form {$params['id']} is being edited.",
                'INFO'
            );

            return new TemplateView(
                'update_view', [
                'title' => 'Editing',
                'form' => $form
            ]);
        } else {
            Logger::log("Form is not found. Id: {$params['id']}.", 'INFO');
            return new TemplateView('404_view', [
                'title' => 404,
                'id' => $params['id'],
            ]);

        }
    }

    public function update($params, $post) : ViewInterface
    {
        $post['form']['id'] = $params['id'];

        $query = new Query();
        $query->execute(
            "UPDATE forms SET title = :title, content = :content WHERE id = :id",
            $post['form']
        );

        $id = $params['id'];
        Logger::log("Form {$id} was updated.", 'INFO');

        return new RedirectView('/forms/view?id=' . $id);
    }
}
