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

    Route::get('recovery',[
        'uses' => 'AuthController@recoveryGet',
        'middleware' => [
            'guest'
        ],
        'as' => 'recovery'
    ]);

    Route::post('recovery',[
        'uses' => 'AuthController@recoveryPost',
        'middleware' => [
            'guest',
            'token',
            'throttle:5,60'
        ]
    ]);

    Route::get('reset/{hash}',[
        'uses' => 'AuthController@resetPasswordGet',
        'middleware' => [
            'guest'
        ],
        'as' => 'reset_password'
    ]);

    Route::post('reset/{hash}',[
        'uses' => 'AuthController@resetPasswordPost',
        'middleware' => [
            'guest',
            'token',
            'throttle:5,60'
        ]
    ]);

    Route::add('activation/{code}',[
        'uses' => 'AuthController@activation',
        'middleware' => ['guest'],
        'as' => 'activation'
    ]);
});
