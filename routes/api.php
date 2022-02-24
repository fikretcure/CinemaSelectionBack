<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiletController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FilmController;
use App\Http\Middleware\AuthMiddleware;
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

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get("emptySeat", [BiletController::class, "emptySeat"]);
    Route::get("city/cinemasAndFilmsByCity", [CityController::class, "cinemasAndFilmsByCity"]);
    Route::controller(AuthController::class)->group(function () {
        Route::post("auth/login", "login");
        Route::post("auth/check", "check");
    });
    Route::apiResources([
        'city' => CityController::class,
        'cinema' => CinemaController::class,
        'film' => FilmController::class,
        'bilet' => BiletController::class,
    ]);
});
