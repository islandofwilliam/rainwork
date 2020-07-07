# rainwork
A simple PHP MVC web framework for JSON APIs made for my practise.

This framework is specifically for use in ReST APIs since it was originally created for private use. 

P.S the codebase is probably far from perfect, this is my first open source project.

# Getting Started

Firstly, to register a route, open routes.php and place a new line as demonstrated

```php
// routes.php

function register_routes()
{
    Router::register('GET', '/hello', 'WelcomeController@index');
}
```

Then, create your controller in the `controllers` folder

```php
// controllers/WelcomeController.php

namespace App\Controller;

include_once __DIR__ . '/../Etc/Request.php';
include_once __DIR__ . '/../Etc/Response.php';

use App\Etc\Request;
use App\Etc\Response;

class WelcomeController 
{
    public function index( Request $r )
    {
        new Response( 200, ['msg' => 'Welcome'] );
    }
}
```

To test run, execute `php -S localhost:8000` in a terminal in the directory.

## URI Parameters

```php
// routes.php

function register_routes()
{
    Router::register('GET', '/hello/:name', 'WelcomeController@welcome');
}
```

```php
// controllers/WelcomeController.php

namespace App\Controller;

include_once __DIR__ . '/../Etc/Request.php';
include_once __DIR__ . '/../Etc/Response.php';

use App\Etc\Request;
use App\Etc\Response;

class WelcomeController 
{
    public function welcome( Request $r )
    {
        new Response( 200, ['msg' => 'Welcome ' . $r->params['name']] );
    }
}
```

## Middleware

Registering a route with middleware
```php
// routes.php

function register_routes()
{
    Router::register('GET', '/protectedroute', 'ProtectedRouteController@index', $middleware='AuthMiddleware');
}
```

```php
// middleware/AuthMiddleware.php

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
        if ( isset($r->headers['Auth']) && $r->headers['Auth'] == 'SomeSecretKey' )
            self::accept();
        else
            self::decline();
    }
}
```

# ToDo
* Implement an ORM
* Create a tool to create controllers & middleware

# Discord
Discord is proprietary software & is not end to end encrypted but it's easy and fun to use. You can join my server which has a channel dedicated to it: https://discord.gg/hqRuwe9.
