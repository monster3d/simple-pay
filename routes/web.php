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
    
    /*
    * Route get all reports 
    */
    $app->get('all', 'ReportController@report');

    /*
    * Route get report by client name
    */
    $app->get('client/name/{name}', 'ReportController@reportByName');

    /*
    * Route get report by data from
    */
    $app->get('client/name/{name}/from/{fromData}', 'ReportController@reportByDataFrom');

    /*
    * Route get report by data to
    */
    $app->get('client/name/{name}/to/{toDate}', 'ReportController@reportByDataTo');

    /*
    * Route get report by between data
    */
    $app->get('client/name/{name}/from/{fromData}/to/{toData}', 'ReportController@reportByBetweenData');
});
