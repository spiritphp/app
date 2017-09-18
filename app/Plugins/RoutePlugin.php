<?php

namespace App\Plugins;

use Spirit\Route;
use Spirit\Route\RoutePlugin as Plugin;
use Spirit\Route\Middleware as VendorMiddleware;

class RoutePlugin extends Plugin {

    protected function middleware(Route\Routing $routing)
    {
        $routing->addMiddleware([
            'auth' => VendorMiddleware\Auth::class,
            'guest' => VendorMiddleware\Guest::class,
            'role' => VendorMiddleware\Role::class,
            'throttle' => VendorMiddleware\Throttle::class,
            'token' => VendorMiddleware\Token::class,
        ]);
    }

    protected function routes(Route\Routing $routing)
    {
        $routing->group([
            'namespace' => 'App\Controllers'
        ], function(){
            $this->loadRoute('web.php');
        });

        $routing->group([
            'prefix' => 'auth',
            'namespace' => 'App\Controllers',
        ], function(){
            $this->loadRoute('auth.php');
        });
    }
}