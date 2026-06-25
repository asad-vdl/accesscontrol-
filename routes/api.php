<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccessController;
use App\Http\Controllers\Api\DeviceHeartbeatController;


/*Route::post('/access-check',
[
    AccessController::class,
    'check'
]);*/

Route::post('/access-check',
[
    AccessController::class,
    'check'
])->middleware('device.token');

Route::post('/device/heartbeat', [DeviceHeartbeatController::class, 'heartbeat']);