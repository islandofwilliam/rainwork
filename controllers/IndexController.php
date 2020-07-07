<?php

namespace App\Controller;

include_once __DIR__ . '/../Etc/Request.php';
include_once __DIR__ . '/../Etc/Response.php';

use App\Etc\Request;
use App\Etc\Response;

class IndexController 
{
    public function index( Request $r )
    {
        new Response( 200, ['msg' => 'ok'] );
    }
}