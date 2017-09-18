<?php

namespace App\Plugins;

use Spirit\Route;
use Spirit\Route\RoutePlugin as Plugin;

class RoutePlugin extends Plugin {

    protected function routes(Route\Routing $routing)
    {
        $routing->group([
            'namespace' => 'App\Controllers'
        ], function(){
            $this->loadRoute('web.php');
        });
    }
}