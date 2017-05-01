<?php

//namespace App;
use App\ConfigParser;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Grab settings in config based on route (route does not denote context)
$config = ConfigParser::Instance();
$urls = $config->get_config();

// Route URLs should also be set in config?

// Page requests
foreach ($urls as $url => $setup) {
    $app->get($url, 'PageController@SetupPage');
}

// General data request, on new connection
$app->get('foo', function () {
    return 'Hello World';
});



//
//$app->get('/', function () use ($app) {
//    $results = app('db')->select("SELECT * FROM article");
//    return $results;
//});

// TODO; Remove this oontroller
//$app->get('start', 'TransformationController@Transform');

