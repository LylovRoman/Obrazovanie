<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*

    Route::get('/export/csv', [ReportExportController::class, 'csv'])->name('reports.export.csv');
    Route::get('/export/xls', [ReportExportController::class, 'xls'])->name('reports.export.xls');
    Route::get('/export/pdf', [ReportExportController::class, 'pdf'])->name('reports.export.pdf');

 */

// Регистрация пользователей
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Аутентификация пользователей
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->middleware('role:admin')->group(function (){
    Route::group(['prefix' => '/users'], function () {
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/', [UserController::class, 'index'])->name('users.index');
    });

    Route::group(['prefix' => '/reports'], function () {
        Route::get('/create', [ReportController::class, 'create'])->name('reports.create');
        Route::post('/', [ReportController::class, 'store'])->name('reports.store');
        Route::get('/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit');
        Route::post('/{report}', [ReportController::class, 'update'])->name('reports.update');
        Route::get('/{report}/delete', [ReportController::class, 'destroy'])->name('reports.destroy');
    });
});

Route::middleware('auth')->group(function (){
    Route::get('/', function () {
        if (Auth::user()->role === 'admin') {
            return redirect(route('users.index'));
        } else {
            return redirect(route('users.show', ['user' => Auth::user()]));
        }
    })->name('main');

    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');

    Route::group(['prefix' => '/reсords'], function () {
        Route::get('/create', [RecordController::class, 'create'])->name('records.create');
        Route::get('/{record}', [RecordController::class, 'show'])->name('records.show');
        Route::post('/', [RecordController::class, 'store'])->name('records.store');
        Route::get('/{record}/edit', [RecordController::class, 'edit'])->name('records.edit');
        Route::post('/{record}', [RecordController::class, 'update'])->name('records.update');
        Route::get('/{record}/delete', [RecordController::class, 'destroy'])->name('records.destroy');
        Route::get('/', [RecordController::class, 'index'])->name('records.index');
    });
});
