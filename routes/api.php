<?php

use App\Http\Controllers\Api\Auth\ConnexionController;
use App\Http\Controllers\Api\Beta\HomeController;
use App\Http\Controllers\Api\Beta\MangaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::post('register', [ConnexionController::class, 'register'])->middleware('guest:sanctum');
// Route::post('login', [ConnexionController::class, 'login'])->middleware('guest:sanctum');
// Route::post('logout', [ConnexionController::class, 'logout'])->middleware('auth:sanctum');

Route::group([
    'prefix' => 'v.beta',
    'as' => 'api.',
    // 'namespace' => ''
], function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    
    Route::post('register', [ConnexionController::class, 'register'])->middleware('guest:sanctum');
    Route::post('login', [ConnexionController::class, 'login'])->middleware('guest:sanctum');
    Route::post('logout', [ConnexionController::class, 'logout'])->middleware('auth:sanctum');


    Route::get('/home', [HomeController::class, 'index'])->middleware('guest:sanctum');
    Route::get('/manga/{slug}', [HomeController::class, 'show'])->middleware('guest:sanctum');


    Route::post('/create/manga', [MangaController::class, 'create'])->middleware('auth:sanctum');

});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


