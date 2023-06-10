<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameUserController;
use App\Http\Controllers\RegisterCodeController;
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
    
    Route::prefix('game')->group(function(){
        Route::get('/loading_auth', [GameController::class, 'loadingAuth'])->name('api.server.loading_auth');
    });

    Route::prefix('register_code')->group(function(){
        Route::get('/', [RegisterCodeController::class, 'index'])->name('api.server.register_code.index');
        Route::get('/get', [RegisterCodeController::class, 'get'])->name('api.server.register_code.get');
        Route::post('/store', [RegisterCodeController::class, 'store'])->name('api.server.register_code.store');
        Route::post('/delete', [RegisterCodeController::class, 'delete'])->name('api.server.register_code.delete');
    });
});
