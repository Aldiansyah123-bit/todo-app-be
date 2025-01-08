<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(\App\Http\Controllers\TodoController::class)->group(function () {
    Route::get('/task', 'index');
    Route::post('/task', 'store');
    Route::put('/task/{id}', 'update');
    Route::delete('/task/{id}', 'destroy');
    Route::post('/task/reorder', 'reorder');
});