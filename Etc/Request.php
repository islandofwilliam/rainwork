<?php

namespace App\Etc;

include_once __DIR__ . '/Request.php';

class Request
{
    public $method;
    public $uri;
    public $body;
    public $params;

    public function __construct()
    {
        $this->method     = $_SERVER['REQUEST_METHOD'];
        $this->uri        = $_SERVER['REQUEST_URI'];
        $this->body       = file_get_contents( 'php://input' );
        $this->params     = Array();
    }
}