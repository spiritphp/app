<?php

Route::group([
    'prefix' => 'auth'
],function(){

    Route::get('captcha/{unique_id}','AuthController@captcha');

    Route::add('login',[
        'uses' => 'AuthController@login',
        'middleware' => ['guest']
    ]);

    Route::add('registration',[
        'uses' => 'AuthController@registration',
        'middleware' => ['guest']
    ]);

    Route::add('logout',[
        'uses' => 'AuthController@logout',
        'middleware' => ['auth']
    ]);

    Route::add('recovery/{hash?}',[
        'uses' => 'AuthController@recovery',
        'middleware' => ['guest']
    ]);

    Route::add('app/{type?}',[
        'uses' => 'AuthController@app',
        'middleware' => ['guest']
    ]);

    Route::add('activation/{code}',[
        'uses' => 'AuthController@activation',
        'middleware' => ['guest']
    ]);

});

