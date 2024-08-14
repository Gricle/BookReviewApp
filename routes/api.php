<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/register', [Api\AuthController::class, 'register']);
    Route::post('/login', [Api\AuthController::class, 'login']);
    Route::post('/logout', [Api\AuthController::class, 'logout'])
    ->middleware('auth:sanctum');;

});

