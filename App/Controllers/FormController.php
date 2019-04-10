<?php

namespace App\Controllers;

use App\Database\Query;
use App\Logger;
use App\LogLevel;
use App\Views\RedirectView;
use App\Views\TemplateView;

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

        if ($form) {
            new Logger(LogLevel::INFO, 'post was fined', $form);
        } elseif (empty($form)) {
            new Logger(LogLevel::ERROR, 'post wasn\'t fined', $params);
        } elseif (empty($params['id'])) {
            new Logger(LogLevel::ERROR, 'missing post-id', $params);
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

        if (empty($post)) {
            new Logger(LogLevel::ERROR, 'missing info for creating post');
        } else {
            new Logger(LogLevel::INFO, 'created new post', $post);
        }

        $query->execute(
            "INSERT INTO forms (title, content) VALUES (:title, :content)",
            $post['form']
        );

        $id = $query->getLastInsertId();

        return new RedirectView('/forms/view?id=' . $id);
    }

    public function delete($params)
    {
        if (empty($params)) {
            new Logger(LogLevel::ERROR, 'missing params for deleting');
        }
        (new Query)->execute("DELETE FROM forms WHERE id = ?", [$params['id']]);
        return new RedirectView('/forms');
    }
}
