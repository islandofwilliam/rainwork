<?php

/**
 * Register all API routes in this file.
 */

include_once __DIR__ . '/Etc/Router.php';

use App\Etc\Router;

function register_routes()
{
    Router::register('GET', '/', 'IndexController@index');
}