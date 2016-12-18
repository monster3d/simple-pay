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
    
    /*
    * Route add new client
    */
    $app->post('client/add', 'ClientController@add');
    
    /*
    * Route get client info by uid
    */
    $app->get('client/info/uid/{uid}', 'ClientController@info');
});




#$app->get('test/{id}', 'ExampleController@show');