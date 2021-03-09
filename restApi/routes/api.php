<?php

use App\Http\Controllers\Country\CountryController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('country', [\App\Http\Controllers\Api\Country\CountryController::class, 'country']);

Route::get('country/{id}', [\App\Http\Controllers\Api\Country\CountryController::class, 'countryById']);

Route::post('country', [\App\Http\Controllers\Api\Country\CountryController::class, 'countryAdd']);

Route::put('country/{id}', [\App\Http\Controllers\Api\Country\CountryController::class, 'countryEdit']);

Route::delete('country/{id}', [\App\Http\Controllers\Api\Country\CountryController::class, 'countryDelete']);

Route::post('login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login']);
