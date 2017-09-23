<?php

Route::add('login',[
    'uses' => 'AuthController@login',
    'middleware' => ['guest'],
    'as' => 'login'
]);

Route::add('join',[
    'uses' => 'AuthController@join',
    'middleware' => ['guest'],
    'as' => 'join'
]);

Route::add('logout',[
    'uses' => 'AuthController@logout',
    'middleware' => ['auth'],
    'as' => 'logout'
]);

Route::add('recovery/{hash?}',[
    'uses' => 'AuthController@recovery',
    'middleware' => ['guest'],
    'as' => 'recovery'
]);

Route::add('activation/{code}',[
    'uses' => 'AuthController@activation',
    'middleware' => ['guest'],
    'as' => 'activation'
]);