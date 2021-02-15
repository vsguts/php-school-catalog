<?php

namespace App\Views;

class JsonView implements ViewInterface
{
    private $data;

    private $statusCode;

    public function __construct(array $data, int $statusCode = 200)
    {
        $this->data = $data;

        $this->statusCode = $statusCode;
    }


    public function render(): void
    {
        header('Content-type: application/json');
        header('Status:' . $this->statusCode);

        echo json_encode($this->data);
    }
}
