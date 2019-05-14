<?php

namespace App\Controllers;

use App\Database\Query;
use App\Views\{JsonView, ViewInterface, RedirectView};
use App\Logger;

class APIController
{
    public function index($params = []) : ViewInterface
    {
        $query = new Query();
        $forms = $query->getList("SELECT * FROM forms");

        Logger::log('Form list was displayed.', 'INFO');
        return new JsonView($forms, 200);
    }

    public function view($params) : ViewInterface
    {
        $query = new Query();
        $form = $query->getRow(
            "SELECT * FROM forms WHERE id = ?",
            [$params['id']]
        );

        if ($form) {
            Logger::log("Form {$params['id']} was displayed.", 'INFO');
            return new JsonView($form, 200);
        } else {
            Logger::log("Form not found. Id: {$params['id']}.", 'INFO');
            return new JsonView([], 404);
        }
    }

    public function create($params, $post) : ViewInterface
    {
        if(!($post['form']['title'] && $post['form']['content'])) {
            Logger::log('Not enough data to create a new form.', 'WARN');
            echo 'Please, enter BOTH title and content to create a new form.';
            throw new \Exception('Not enough data to create a new form.');
        }

        $query = new Query();
        $query->execute(
            "INSERT INTO forms (title, content) VALUES (:title, :content)",
            $post['form']
        );

        $id = $query->getLastInsertId();
        Logger::log("Form {$id} was created.", 'INFO');

        return new RedirectView('/api/forms/view?id=' . $id, 201);
    }

    public function delete($params) : ViewInterface
    {
        (new Query)->execute("DELETE FROM forms WHERE id = ?", [$params['id']]);

        Logger::log("Form {$params['id']} was deleted.", 'INFO');

        return new RedirectView('/api/forms', 410);
    }

    public function update($params)
    {
        $form = json_decode(file_get_contents('php://input'), true);
        $form['id'] = $params['id'];

        $query = new Query();
        $query->execute(
            "UPDATE forms SET title = :title, content = :content WHERE id = :id",
            $form
        );

        $id = $params['id'];
        Logger::log("Form {$id} was updated.", 'INFO');

        return new RedirectView('/api/forms/view?id=' . $id, 201);
    }

}