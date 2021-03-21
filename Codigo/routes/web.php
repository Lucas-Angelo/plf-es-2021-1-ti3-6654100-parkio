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
});



/* Web Site Routes */
$router->get('/test', function () use ($router) { // used in Browser URL
    return view('test', ['name' => 'Oliveira']); // View Name (Same name as in resources/views), custom parameters
});