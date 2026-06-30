<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\AccessLogController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

         // Access Terminal

    Route::get('/access-terminal', function () {


        return redirect('http://127.0.0.1:9000/');


    })->name('access.terminal');

    Route::resource('users', UserController::class);

    Route::resource('devices', DeviceController::class);

    Route::resource('credentials', CredentialController::class);

    Route::get('/access-logs',
        [AccessLogController::class, 'index'])
        ->name('access.logs');

});