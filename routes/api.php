<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameUserController;
use App\Http\Controllers\ServerController;
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

Route::post('login', [AuthController::class, 'signin'])->name('api.login');
Route::post('register', [AuthController::class, 'signup'])->name('api.register');

Route::middleware('auth:sanctum')->group(function(){

    Route::middleware('gunny.databases')->group(function(){
        Route::prefix('character')->group(function(){
            Route::get('/', [GameUserController::class, 'index'])->name('api.character.index');
        });
    });

    Route::prefix('server')->group(function(){
        Route::get('/', [ServerController::class, 'index'])->name('api.server.index');
    });
    
});
