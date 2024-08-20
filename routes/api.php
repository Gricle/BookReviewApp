<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\AuthorController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/register', [Api\AuthController::class, 'register']);
    Route::post('/login', [Api\AuthController::class, 'login'])
    ->name('login');
    Route::post('/logout', [Api\AuthController::class, 'logout'])
    ->middleware('auth:sanctum');;
});
Route::prefix('authors')->group(function () {
    Route::post('/', [AuthorController::class, 'store']);
    Route::get('/', [AuthorController::class, 'index']);
    Route::get('/{id}', [AuthorController::class, 'show']);
    Route::delete('/{id}', [AuthorController::class, 'destroy'])
    ->middleware('auth:sanctum');
    Route::put('/{id}', [AuthorController::class, 'update'])
    ->middleware('auth:sanctum');
});