<?php

namespace App\Controllers;

use App\Database\Query;
use App\Logger\LogLevel;
use App\Views\RedirectView;
use App\Views\TemplateView;

/**
 * Class FormController
 *
 * @package App\Controllers
 */
class FormController extends BaseController
{
    public function index($params = [])
    {
        $query = new Query();
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
            $this->getLogger()->log(LogLevel::INFO, 'post was fined', $form);
        } elseif (empty($form)) {
            $this->getLogger()->log(LogLevel::ERROR, 'post wasn\'t fined', $params);
        } elseif (empty($params['id'])) {
            $this->getLogger()->log(LogLevel::ERROR, 'missing post-id', $params);
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
            $this->getLogger()->log(LogLevel::ERROR, 'missing info for creating post');
        } else {
            $this->getLogger()->log(LogLevel::INFO, 'created new post', $post);
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
            $this->getLogger()->log(LogLevel::ERROR, 'missing params for deleting');
        }
        (new Query)->execute("DELETE FROM forms WHERE id = ?", [$params['id']]);
        return new RedirectView('/forms');
    }
}
