<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/


$app->group(['prefix' => 'web'], function() use($app) {
  
    /*
    * Main page
    */
    $app->get('/', 'WebController@index');
});


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
    * Route for transfer
    */
    $app->post('transfer', 'TransferController@transfer');

    /*
    * Route for upload currency rate
    */
    $app->post('rate/usd/add', 'RateController@add');
});


$app->group(['prefix' => 'report', 'middleware' => 'App\Http\Middleware\CleanerMiddleware'], function() use($app) {
    
    /*
    * Route get all reports 
    */
    $app->get('all[/{format}]', 
        function(Illuminate\Http\Request $request, $format = null) use($app) 
        {
            $reportController = $app->make('App\Http\Controllers\ReportController');
            return $reportController->report($request, $format);
        }
    );

    /*
    * Route get report by client name
    */
    $app->get('client/name/{name}[/{format}]', 'ReportController@reportByName');
    $app->get('client/name/{name}[/{format}]', 
        function(Illuminate\Http\Request $request, $name, $format = null) use($app) 
        {
            $reportController = $app->make('App\Http\Controllers\ReportController');
            return $reportController->reportByName($request, $name, $format);
        }
    );

    /*
    * Route get report by data from
    */
    $app->get('client/name/{name}/from/{from_date}[/{format}]', 
        function(Illuminate\Http\Request $request, $name, $from_date, $format = null) use($app) 
        {
            $reportController = $app->make('App\Http\Controllers\ReportController');
            return $reportController->reportByDateFrom($request, $name, $from_date, $format);
        }
    );

    /*
    * Route get report by data to
    */
    $app->get('client/name/{name}/to/{to_date}[/{format}]', 
        function(Illuminate\Http\Request $request, $name, $to_date, $format = null) use($app) 
        {
            $reportController = $app->make('App\Http\Controllers\ReportController');
            return $reportController->reportByDateTo($request, $name, $to_date, $format);
        }
    );

    /*
    * Route get report by between data
    */
    $app->get('client/name/{name}/from/{from_date}/to/{to_date}[/{format}]', 
        function(Illuminate\Http\Request $request, $name, $from_date, $to_date, $format = null) use($app) 
        {
            $reportController = $app->make('App\Http\Controllers\ReportController');
            return $reportController->reportByBetweenDate($request, $name, $from_date, $to_date, $format);
        }
    );

});
