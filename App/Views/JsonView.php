<?php


namespace App\Views;


class JsonView implements ViewInterface
{
    private $statusCode;
    private $data;

    public function __construct(array $data, int $statusCode)
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    public function render()
    {
        header('Content-type: application/json');
        header('Status Code:' . $this->statusCode);
        echo json_encode($this->data);

    }

}