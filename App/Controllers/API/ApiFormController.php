<?php
declare(strict_types=1);

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Database\Query;
use App\Logger\LogLevel;
use App\Views\JsonView;

/**
 * Class ApiFormController
 *
 * @package App\Controllers\API
 */
class ApiFormController extends BaseController
{
    /**
     * @return JsonView
     */
    public function index(): JsonView
    {
        $query = new Query();
        $forms = $query->getList('SELECT * FROM forms');

        return new JsonView($forms);
    }


    /**
     * @param array $params
     * @return JsonView
     */
    public function view($params = []): JsonView
    {
        $query = new Query();
        $form = $query->getRow(
            'SELECT * FROM forms WHERE id = ?',
            [$params['id']]
        );

        if ($form) {
            $this->getLogger()->log(LogLevel::INFO, 'post was fined', $form);
        } elseif (empty($form)) {
            $this->getLogger()->log(LogLevel::ERROR, 'post wasn\'t fined', $params);
        } elseif (empty($params['id'])) {
            $this->getLogger()->log(LogLevel::ERROR, 'missing post-id', $params);
        }

        return new JsonView($form, 200);
    }

    /**
     * @param array $params
     * @return JsonView
     */
    public function update($params = []): JsonView
    {
        $query = new Query();
        $form = $query->getRow(
            "SELECT * FROM forms WHERE id = ?",
            [$params['id']]
        );
        return new JsonView($form, 201);
    }

    /**
     * @param array $post
     * @return JsonView
     */
    public function save(array $post = []): JsonView
    {
        var_dump($post);
        $query = new Query();
        $query->execute(
            "UPDATE forms SET title = :title, content = :content WHERE id = :id",
            $post['form']
        );
        return new JsonView($post['form'], 201);
    }

    /**
     * @param array $post
     * @return JsonView
     */
    public function create(array $post): JsonView
    {
        $query = new Query();
        if (empty($post)) {
            $this->getLogger()->log(LogLevel::ERROR, 'missing info for creating post');
        } else {
            $this->getLogger()->log(LogLevel::INFO, 'created new post', $post);
        }
        $query->execute(
            'INSERT INTO forms (title, content) VALUES (:title, :content)',
            $post['form']
        );

        $id = $query->getLastInsertId();
        $data = $query->getRow(
            'SELECT * FROM forms WHERE id = ?',
            $id
        );
        return new JsonView($data, 201);
    }

    /**
     * @param array $params
     * @return JsonView
     */
    public function delete(array $params = []): JsonView
    {
        if (empty($params)) {
            $this->getLogger()->log(LogLevel::ERROR, 'missing params for deleting');
        }

        $query = new Query();

        $data = $query->getRow(
            'SELECT * FROM forms WHERE id = ?',
            $params['id']
        );
        $query->execute('DELETE FROM forms WHERE id = ?', [$params['id']]);
        return new JsonView($data);
    }
}
