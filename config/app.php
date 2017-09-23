<?php
use \Spirit\Constructor\Components;

/**
 * @var \Spirit\Config $cfg
 * @var \Spirit\Constructor $constructor
 */
$cfg->appKey = env('APP_KEY');

$cfg->defaultDBConnection = env('DATABASE_DRIVER');
$cfg->connections['pgsql']['database'] = env('PGSQL_DATABASE');
$cfg->connections['pgsql']['user'] = env('PGSQL_USER');
$cfg->connections['pgsql']['password'] = env('PGSQL_PASSWORD');

$cfg->plugins = [
    App\Plugins\RoutePlugin::class
];

$constructor->addLayoutContent('app.php')
    ->addDebug();