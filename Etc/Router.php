<?php

namespace App\Etc;

include_once __DIR__ . '/Request.php';
include_once __DIR__ . '/Response.php';
include_once __DIR__ . '/Route.php';

use App\Etc\Request;
use App\Etc\Response;
use App\Etc\Route;

class Router
{
    private static $routes = Array();

    public static function register( $method, $route, $controller, $middleware = null )
    {
        array_push( self::$routes, new Route( $route, $method, $controller, $middleware ) );
    }

    public static function handle( Request $r )
    {
        foreach ( self::$routes as $route )
        {
            $reg_uri_parts = explode( '/', $route->uri );
            $req_uri_parts = explode( '/', $r->uri );

            $params_match = false;

            if ( sizeof($reg_uri_parts) == sizeof($req_uri_parts) )
            {
                for ( $i; $i<=sizeof($reg_uri_parts); $i++ )
                {
                    if ( substr( $reg_uri_parts[$i], 0, 1 ) === ':' )
                    {
                        // this block is a parameter            
                        $r->params[ substr( $reg_uri_parts[$i], 1, strlen($reg_uri_parts[$i]) ) ] = $req_uri_parts[$i];

                        $params_match = true;
                    }
                    else if ( $reg_uri_parts[$i] == $req_uri_parts[$i] )
                    {   
                        $params_match = true;
                        continue;
                    }
                    else
                    {
                        $params_match = false;
                        break;
                    }
                }
            }


            if ( $params_match || $route->uri === $r->uri )
            {
                if ( $route->method !== $r->method )
                    return new Response( 405, [ 'msg' => 'method not allowed' ] );

                if ( $route->mw )
                {
                    $mw_class = 'App\Middleware\AuthMiddleware';

                    include_once __DIR__ . '/../middleware/' . $route->mw . '.php';

                    $mw_reflect = new $mw_class;
                    $mw_reflect->handle( $r );
                }

                $controller_class = 'App\Controller\\' . $route->controller['class'];

                include_once __DIR__ . '/../controllers/' . $route->controller['class'] . '.php';

                $reflect = new $controller_class;

                call_user_func_array( Array( $reflect, $route->controller['fn'] ), Array( $r ) );

                exit;
            }
        }

        return new Response( 404, [ 'msg' => 'not found' ] );
    }
}

