<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Device;
use App\Models\Credential;
use App\Models\AccessLog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalDevices = Device::count();

        $onlineDevices = Device::where(
            'online_status',
            1
        )->count();

        $offlineDevices = Device::where(
            'online_status',
            0
        )->count();

        $activeUsers = User::where(
    'status',
    1
)->count();

$inactiveUsers = User::where(
    'status',
    0
)->count();

        $totalCredentials = Credential::count();

        $todayAccessLogs = AccessLog::whereDate(
            'created_at',
            Carbon::today()
        )->count();

        $grantedAccess = AccessLog::where(
            'access_status',
            'granted'
        )->count();

        $deniedAccess = AccessLog::where(
            'access_status',
            'denied'
        )->count();

        $recentLogs = AccessLog::with([
    'user',
    'device'
])
->latest()
->take(10)
->get();
$devices = Device::latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(

    'totalUsers',
    'totalDevices',
    'onlineDevices',
    'offlineDevices',
    'activeUsers',
'inactiveUsers',
    'totalCredentials',
    'todayAccessLogs',
    'grantedAccess',
    'deniedAccess',
    'recentLogs',
     'devices'

));
    }
}
