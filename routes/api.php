<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/add-items', [\App\Http\Controllers\MovieController::class, 'addItems']);
Route::get('/add-items-properties', [\App\Http\Controllers\MovieController::class, 'addItemsProperties']);
Route::get('/add-users-views', [\App\Http\Controllers\MovieController::class, 'addUsersAndViews']);
Route::get('/recommended-movies', [\App\Http\Controllers\MovieController::class, 'recommendedMovies']);
