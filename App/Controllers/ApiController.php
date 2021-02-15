<?php


namespace App\Controllers;

use App\Views\JsonView;
use App\Database\Query;


class ApiController
{
    /** @object Query */
    private $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    /**
     * @return JsonView
     */
    public function index()
    {
        $forms = $this->query->getList("SELECT * FROM forms");

        return new JsonView($forms);
    }

    /**
     * @param $params
     * @param array $post
     * @return JsonView
     */
    public function create($params, array $post)
    {
        $queryStr = "INSERT INTO forms (title, content) VALUES (:title, :content)";

        $this->query->execute($queryStr, $post);

        $id = $this->query->getLastInsertId();

        return new JsonView(['result' => 'ok', 'last_insert_id' => $id]);

    }

    /**
     * @param $params
     * @param array $post
     * @return JsonView
     */
    public function delete($params, array $post)
    {
        $queryStr = "DELETE FROM forms WHERE id = ?";

        $this->query->execute($queryStr, [$post['id']]);

        return new JsonView(['result' => 'post_has_been_deleted', 'id' => $post['id']]);
    }

    /**
     * @param $params
     * @param array $post
     * @return JsonView
     */
    public function update($params, array $post)
    {
        $queryStr = "UPDATE `forms` SET `title` = :title, `content` = :content WHERE `id` = :id";

        $this->query->execute($queryStr, $post);

        return new JsonView(['result' => 'post_has_been_updated', 'id' => $post['id'], 'updated_title' => $post['title'], 'content' => $post['content']]);

    }
}