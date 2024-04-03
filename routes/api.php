<?php

use App\Http\Controllers\Api\Auth\ConnexionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [ConnexionController::class, 'register']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


