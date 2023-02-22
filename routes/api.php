<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\RestReadController;
use App\Http\Controllers\RestCreateController;
use App\Http\Controllers\RestUpdateController;
use App\Http\Controllers\RestDeleteController;

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

Route::get('/api/locations/{lat}/{lng}/{zoom}.json', [DataController::class, 'locations']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::group();
$router->group(['prefix' => 'api/{table}', 'middleware' => 'auth'], function () use ($router) {

    $router->get('', [RestReadController::class, 'get']);
    $router->get('/{id}', [RestReadController::class, 'getAt']);

    $router->post('', [RestCreateController::class, 'insert']);

    $router->put('/{id}', [RestUpdateController::class, 'update']);
    $router->post('/{id}', [RestUpdateController::class, 'update']);
    $router->put('/where/{col}/{val}', [RestUpdateController::class, 'updateWhere']);

    $router->delete('/{id}', [RestDeleteController::class, 'delete']);
    $router->delete('/{id}/restore', [RestDeleteController::class, 'restore']);
});