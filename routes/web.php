<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [Controller::class, 'index']);
Route::get('/c/{connID}', [Controller::class, 'cable']);
Route::post('/p/{pointID}', [Controller::class, 'addPoint']);
Route::delete('/p/{pointID}', [Controller::class, 'deletePoint']);

Route::post('/api/location', [Controller::class, 'saveLocation']);
Route::post('/api/connection', [Controller::class, 'saveConnection']);
Route::post('/api/hop-line/{hopID}', [Controller::class, 'updateHopLine']);


Route::get('/v3', [Controller::class, 'v3']);