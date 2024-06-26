<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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


$router->group(['middleware' => 'logSystem'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
    $router->group(['middleware' => 'auth'], function () use ($router) {

        $router->post('costumers', ['middleware' => 'costumerInsert', 'uses' => 'CostumersController@insert']);
        $router->get('costumers', ['middleware' => 'costumerGetEmailOrDni', 'uses' => 'CostumersController@get']);
        $router->delete('costumers', ['middleware' => 'costumerDeleteDni', 'uses' => 'CostumersController@delete']);
    });
    $router->post('login', ['middleware' => 'login2', 'uses' => 'LoginController@login']);
});
