<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('1', function ($api) {
    $api->group(['prefix' => 'v1'], function ($api) {
        $api->get('/ping', 'App\Http\Controllers\PingController@ping');


        $api->group(['middleware' => 'request.integrity'], function ($api) {
            $api->get('/user', 'App\Http\Controllers\UserController@index');
            $api->post('/user', 'App\Http\Controllers\UserController@create');
        });

    });
});
