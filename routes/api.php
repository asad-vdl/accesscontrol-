<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccessController;
use App\Http\Controllers\Api\DeviceHeartbeatController;
use App\Http\Controllers\Api\DeviceController;


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

Route::get(
    '/device/token/{device_code}',
    [DeviceController::class, 'token']
);

Route::get(
    '/devices',
    [DeviceController::class, 'list']
);