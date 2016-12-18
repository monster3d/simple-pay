<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'api'], function() use($app) {
    $app->post('client/add', 'ClientController@add');
});




#$app->get('test/{id}', 'ExampleController@show');