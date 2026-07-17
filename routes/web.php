<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\AccessLogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\GateController;

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

        Route::get('/dashboard/live-stats', [DashboardController::class, 'liveStats'])
    ->name('dashboard.live-stats');

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

       // Route::resource('gates', App\Http\Controllers\GateController::class);
        Route::resource('gates', GateController::class);

        /*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

  Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

});