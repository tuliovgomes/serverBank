<?php

$api->group(['prefix' => 'auth'], function ($api) {
    $api->post('login', 'App\Http\Controllers\AuthController@login');
    $api->post('logout', 'App\Http\Controllers\AuthController@logout');
    $api->post('refresh', 'App\Http\Controllers\AuthController@refresh');
    $api->post('me', 'App\Http\Controllers\AuthController@me');
});
