<?php

namespace App\Middleware;

include_once __DIR__ . '/../Etc/Request.php';
include_once __DIR__ . '/../Etc/Response.php';

use App\Etc\Request;
use App\Etc\Response;

abstract class BaseMiddleware
{
    protected const STD_DECLINE_STATUS = 404;
    protected const STD_DECLINE_JSON   = [ 'msg' => 'not found' ];

    public function __construct()
    {
    }

    protected function accept(  ): bool
    {
        return true;
    }

    protected function decline(): Response
    {   
        new Response( static::STD_DECLINE_STATUS, static::STD_DECLINE_JSON );
    }

    abstract public function handle( Request $r );
}