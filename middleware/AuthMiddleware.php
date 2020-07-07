<?php

namespace App\Middleware;

include_once __DIR__ . '/BaseMiddleware.php';
include_once __DIR__ . '/../Etc/Request';

use App\Middleware\BaseMiddleware;
use App\Etc\Request;

class AuthMiddleware extends BaseMiddleware
{
    protected const STD_DECLINE_STATUS = 401;
    protected const STD_DECLINE_JSON   = [ 'msg' => 'unauthorized' ];

    public function handle( Request $r )
    {
        if ( isset($r->headers['AuthToken']) && $r->headers['AuthToken'] == 'TEST' )
        {
            self::accept();
        }
        else
        {
            self::decline();
        }
    }
}