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


/**
 * API Routes
 */


$router->group(['prefix' => '/api'], function () use ($router) {
    $router->post('/auth', 'UserController@auth'); // Login Endpoint

    $router->group(['middleware' => ['jwt.auth']], function () use ($router) {
        //users
        $router->post('/users', 'UserController@create'); // Route path (used for requests), Controller (Same name as in folder)@Public_function_name
        $router->get('/users', 'UserController@getAll');
        $router->get('/users/search', 'UserController@search');
        $router->delete('/users/{id}', 'UserController@delete');

        //vehicles
        $router->get('/vehicles', 'VehicleController@getAll'); // Search for all vehicles entries
        $router->put('/vehicles/{id}', 'VehicleController@edit'); // Edit one vehicles entries
        $router->get('/vehicles/search', 'VehicleController@search'); // If exists, searches for the last row filtered by the vehicle plate (for autocomplete)
        $router->get('/vehicles/{id}', 'VehicleController@get'); // If exists, searches for the last row filtered by the vehicle plate (for autocomplete)
        $router->post('/vehicles/save', 'VehicleController@create'); // For saving incoming vehicles

        //complains
        $router->post('/complain', 'ComplainController@create');

        //gates
        $router->get('/gate', 'GateController@getAll'); // Search for all gates
        $router->post('/gate', 'GateController@create'); // Route path (used for requests), Controller (Same name as in folder)@Public_function_name
        $router->delete('/gate/{id}', 'GateController@delete');
        $router->get('/gate/{id}', 'GateController@search'); // Find and return a gate
        $router->put('/gate', 'GateController@update'); // Update a gate

        $router->get('/destinations', 'DestinationController@getAll');

        $router->get('/visitorCategory', 'VisitorCategoryController@getAll'); // Route path (used for requests), Controller (Same name as in folder)@Public_function_name
        $router->post('/visitorCategory', 'VisitorCategoryController@create'); // Route path (used for requests), Controller (Same name as in folder)@Public_function_name

        $router->get('/vehicles', 'VehicleController@getAll'); // Search for all vehicles entries
        $router->put('/vehicles/{id}', 'VehicleController@edit'); // Edit one vehicles entries
        $router->get('/vehicles/search', 'VehicleController@search'); // If exists, searches for the last row filtered by the vehicle plate (for autocomplete)
        $router->post('/vehicles', 'VehicleController@create'); // For saving incoming vehicles
    });
});

/* Web Site Routes */
$router->get('/test', function () use ($router) { // used in Browser URL
    return view('pages.test'); // View Name (Same name as in resources/views), custom parameters
});

/*Begin - Web Site Routes */
$router->get('/auth', function () use ($router) {
    return view('pages.login');
});

// Needed auth routes
$router->group(['middleware' => ['web.auth']], function() use ($router) {
    $router->get('/', function () use ($router) {
        return view('pages.menu');
    });


    $router->get('/test', function () use ($router) { // used in Browser URL
        return view('pages.test'); // View Name (Same name as in resources/views), custom parameters
    });

    $router->get('/gate/{id}', function () use ($router) {
        return view('pages.gate');
    });

    $router->get('/vehiclelist', function () use ($router) {
        return view('pages.vehicleslist');
    });

    $router->get('/userlist', function () use ($router) {
        return view('pages.userlist');
    });

    $router->get('/admin', function () use ($router) {
        return view('pages.admin');
    });

});
