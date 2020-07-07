<?php

namespace App\Etc;

class Route
{
    public $uri;
    public $method;
    public $controller;
    public $mw;

    public function __construct( string $uri, string $method, string $controller, ?string $mw )
    {
        $this->uri    = $uri;
        $this->method = $method;
        $this->mw     = $mw;

        $split = explode( '@', $controller );
        $this->controller = Array( 'class' => $split[0], 'fn' => $split[1] );
    }
}