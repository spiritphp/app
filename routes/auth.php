<?php
Route::group([
    'prefix' => 'auth'
], function(){
    Route::get('login',[
        'uses' => 'AuthController@loginGet',
        'middleware' => ['guest'],
        'as' => 'login'
    ]);

    Route::post('login',[
        'uses' => 'AuthController@loginPost',
        'middleware' => ['guest','token'],
    ]);

    Route::get('join',[
        'uses' => 'AuthController@joinGet',
        'middleware' => ['guest',],
        'as' => 'join'
    ]);

    Route::post('join',[
        'uses' => 'AuthController@joinPost',
        'middleware' => ['guest','token'],
    ]);

    Route::add('logout',[
        'uses' => 'AuthController@logout',
        'middleware' => ['auth'],
        'as' => 'logout'
    ]);

    Route::add('recovery',[
        'uses' => 'AuthController@recovery',
        'middleware' => [
            'guest',
            'token',
            'throttle:5,300'
        ],
        'as' => 'recovery'
    ]);

    Route::add('reset/{hash}',[
        'uses' => 'AuthController@resetPassword',
        'middleware' => [
            'guest',
            'token',
            //'throttle:5,300'
        ],
        'as' => 'reset_password'
    ]);

    Route::add('activation/{code}',[
        'uses' => 'AuthController@activation',
        'middleware' => ['guest'],
        'as' => 'activation'
    ]);
});
