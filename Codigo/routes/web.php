<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
Lumen Documentation: https://lumen.laravel.com/docs/7.x/routing
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
 * API Routes
 */
$router->group(['prefix' => '/api'], function () use ($router) {
    $router->post('/users', 'UserController@create'); // Route path (used for requests), Controller (Same name as in folder)@Public_function_name
    $router->get('/users', 'UserController@getAll');


    $router->get('/vehicles', 'VehicleController@getAll'); // Search for all vehicles entries
    $router->put('/vehicles/{id}', 'VehicleController@edit'); // Edit one vehicles entries
    $router->get('/vehicles/search', 'VehicleController@search'); // If exists, searches for the last row filtered by the vehicle plate (for autocomplete)
    $router->post('/vehicles/save', 'VehicleController@create'); // For saving incoming vehicles
});



/* Web Site Routes */
$router->get('/test', function () use ($router) { // used in Browser URL
    return view('pages.test'); // View Name (Same name as in resources/views), custom parameters
});

$router->get('/auth', function () use ($router) {
    return view('pages.login');
});

$router->get('/gate', function () use ($router) {
    return view('pages.gate');
});

$router->get('/vehiclelist', function () use ($router) {
    return view('pages.vehicleslist');
});