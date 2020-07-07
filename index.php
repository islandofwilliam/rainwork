<?php

include_once __DIR__ . '/Etc/Request.php';
include_once __DIR__ . '/Etc/Router.php';
include_once __DIR__ . '/Etc/Response.php';

include_once __DIR__ . '/routes.php';

use App\Etc\Request;
use App\Etc\Router;
use App\Etc\Response;

$req = new Request();

register_routes();

try {
    Router::handle( $req );
} catch ( Exception $e ) {
    if ( PRODUCTION ) {
        new Response( 500, ['msg' => 'interval server error, please contact staff'] );
    } else {
        new Response( 500, [ 'interval_server_err_' => $e->getMessage() ] );
    }
}