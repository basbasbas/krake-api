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
$pageUrls = $config->getPages();
$dataUrls = $config->getData();

// Route URLs should also be set in config?

// Page requests
foreach ($pageUrls  as $url => $setup) {
    $app->get($url, 'PageController@setupPage');
}
// Data requests
foreach ($dataUrls  as $url => $setup) {
    $app->get($url, 'DataController@setupData');
}

//$app->get('api/data', function () {
//    return 'Hello World';
//});



//
//$app->get('/', function () use ($app) {
//    $results = app('db')->select("SELECT * FROM article");
//    return $results;
//});

// TODO; Remove this oontroller
//$app->get('start', 'TransformationController@Transform');

