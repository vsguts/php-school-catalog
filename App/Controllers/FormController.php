<?php

namespace App\Controllers;

use App\Database\Query;
use App\Views\RedirectView;
use App\Views\TemplateView;

class FormController
{
    /**
     * @param array $params
     * @return TemplateView
     */
    public function index($params = [])
    {
        $query = new Query;
        $forms = $query->getList("SELECT * FROM forms");

        return new TemplateView('form_index', [
            'title' => 'My awesome page',
            'forms' => $forms
        ]);
    }

    /**
     * @param array $params
     * @return TemplateView
     */
    public function view($params = []): TemplateView
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

    /**
     * @param array $params
     * @return TemplateView
     */
    public function update($params = []): TemplateView
    {
        $query = new Query();
        $form = $query->getRow(
            "SELECT * FROM forms WHERE id = ?",
            [$params['id']]
        );

        return new TemplateView('form_update', [
            'form' => $form
        ]);
    }

    /**
     * @param array $post
     * @return RedirectView
     */
    public function save(array $post): RedirectView
    {
        var_dump($post);
        $query = new Query();
        $query->execute(
            "UPDATE forms SET title = :title, content = :content WHERE id = :id",
            $post['form']
        );

        return new RedirectView('/forms/view?id=' . $post['form']['id']);
    }

    /**
     * @param array $post
     * @return RedirectView
     */
    public function create(array $post): RedirectView
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

    /**
     * @param array $params
     * @return RedirectView
     */
    public function delete(array $params): RedirectView
    {
        (new Query)->execute("DELETE FROM forms WHERE id = ?", [$params['id']]);
        return new RedirectView('/forms');
    }
}
