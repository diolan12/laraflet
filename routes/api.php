<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::group();
$router->group(['prefix' => 'api/{table}', 'middleware' => 'auth'], function () use ($router) {

    $router->get('', ['uses' => 'RestReadController@get']);
    $router->get('/{id}', ['uses' => 'RestReadController@getAt']);

    $router->post('', ['uses' => 'RestCreateController@insert']);

    $router->put('/{id}', ['uses' => 'RestUpdateController@update']);
    $router->post('/{id}', ['uses' => 'RestUpdateController@update']);
    $router->put('/where/{col}/{val}', ['uses' => 'RestUpdateController@updateWhere']);

    $router->delete('/{id}', ['uses' => 'RestDeleteController@delete']);
    $router->delete('/{id}/restore', ['uses' => 'RestDeleteController@restore']);
});