<?php

namespace App\Views;

class RedirectView implements ViewInterface
{
    private $url;
    private $statusCode;

    public function __construct(string $url, int $statusCode = 200)
    {
        $this->url = $url;
        $this->statusCode = $statusCode;
    }

    public function render()
    {
        header('Location: ' . $this->url);
        header('Status Code: ' . $this->statusCode);
    }
}
