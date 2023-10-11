<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Export\UserExportController;
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

// Регистрация пользователей
//Route::post('/register', [AuthController::class, 'register']);

//Аутентификация пользователей
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/list', [BookController::class, 'list'])->name('api.reports.list');
        Route::get('/by-id/{id}', [BookController::class, 'byId'])->name('api.reports.by-id');
        Route::middleware('role:admin')->group(function (){
            Route::post('/update/{id}', [BookController::class, 'update'])->name('api.reports.update');
            Route::delete('/{id}', [BookController::class, 'destroy'])->name('api.reports.destroy');
        });
    });
    Route::group(['prefix' => '/users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('api.users.index');
        Route::get('/{id}', [UserController::class, 'show'])->name('api.users.show');
        Route::middleware('role:admin')->group(function (){
            Route::post('/{id}/update', [UserController::class, 'update'])->name('api.users.update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('api.users.destroy');
        });
    });
});
