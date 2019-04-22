<?php
declare(strict_types=1);

namespace App\Views;

class JsonView implements ViewInterface
{
    /**
     * @var integer
     */
    private $statusCode;
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data, int $statusCode = 200)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    public function render()
    {
        header('Content-Type: application/json');
        header('Status: ' . $this->statusCode);
        echo json_encode($this->data);
    }
}
