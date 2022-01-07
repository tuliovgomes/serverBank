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

        require 'auth.php';

        $api->group(['middleware' => 'api.auth'], function ($api) {
            // Rotas autenticadas.
            $api->get('protected', function () {
                return 'Hello.';
            });
        });
    });
});
