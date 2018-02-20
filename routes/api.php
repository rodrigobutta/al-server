<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('items', 'ItemController');

// Route::apiResource('users', 'UserController');



Route::apiResource('authenticate', 'AuthenticateController');

Route::group([
    // 'prefix'        => config('admin.route.prefix'),
    // 'namespace'     => config('admin.route.namespace'),
    'middleware'    => ['jwt.auth'],
], function (Router $router) {

    // Route::apiResource('users', 'UserController');

    $router->apiResource('users', 'UserController');

});



// Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
// Route::post('authenticate', 'AuthenticateController@authenticate');
