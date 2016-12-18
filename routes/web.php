<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

$app->get('/version', function () use ($app) {
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

    /*
    * Route fill up client amount
    */
    $app->post('client/fillup', 'ClientController@fillUpAmount');

    /*
    * Route fro transfer
    */
    $app->post('transfer', 'TransferController@transfer');
});


$app->group(['prefix' => 'report'], function() use($app) {
    $app->get('/', 'ReportController@report');
});
