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

$constructor->add(function() {
    return Components\HtmlHead::make()
        ->title('Title Page')
        ->css(['app.css'])
        ->favicon('favicon.ico')
        ->draw();
})
    ->addContent(function($content) {
        return Components\Simple::v('content', ['content' => $content]);
    })
    ->add(function() {
        return Components\HtmlEnd::make()->js(['app.js'])->draw();
    })
    ->addDebug();