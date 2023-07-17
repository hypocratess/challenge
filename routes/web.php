<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/courier', [\App\Http\Controllers\CouriersController::class, 'index']);
Route::get('/courier/{id}', [\App\Http\Controllers\CouriersController::class, 'show']);
Route::Post('/courier', [\App\Http\Controllers\CouriersController::class, 'store']);
Route::put('/courier/{id}', [\App\Http\Controllers\CouriersController::class, 'update']);
Route::delete('/courier/{id}', [\App\Http\Controllers\CouriersController::class, 'delete']);
