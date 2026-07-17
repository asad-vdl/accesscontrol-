<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Device;
use App\Models\Credential;
use App\Models\AccessLog;
use Carbon\Carbon;
use App\Models\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalGates = Gate::count();

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

        $totalAccess = $grantedAccess + $deniedAccess;

$accessSuccessRate = $totalAccess > 0
    ? round(($grantedAccess / $totalAccess) * 100)
    : 0;

     $recentLogs = AccessLog::with([
    'user',
    'device'
        ])
        ->latest()
        ->paginate(10);

$devices = Device::latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(

    'totalUsers',
    'totalGates',
    'totalDevices',
    'onlineDevices',
    'offlineDevices',
    'activeUsers',
    'inactiveUsers',
    'totalCredentials',
    'todayAccessLogs',
    'grantedAccess',
    'deniedAccess',
    'accessSuccessRate',
    'recentLogs',
     'devices'

));
    }

    public function liveStats()
{
    return response()->json([

        'totalUsers' => User::count(),

        'totalGates' => Gate::count(),

        'totalDevices' => Device::count(),

        'onlineDevices' => Device::where(
            'online_status',
            1
        )->count(),

        'offlineDevices' => Device::where(
            'online_status',
            0
        )->count(),

        'activeUsers' => User::where(
            'status',
            1
        )->count(),

        'inactiveUsers' => User::where(
            'status',
            0
        )->count(),

        'totalCredentials' => Credential::count(),

        'todayAccessLogs' => AccessLog::whereDate(
            'created_at',
            Carbon::today()
        )->count(),

        'grantedAccess' => AccessLog::where(
            'access_status',
            'granted'
        )->count(),

        'deniedAccess' => AccessLog::where(
            'access_status',
            'denied'
        )->count(),

        'accessSuccessRate' => (

    ($granted = AccessLog::where('access_status', 'granted')->count()) +

    ($denied = AccessLog::where('access_status', 'denied')->count())

) > 0

? round(($granted / ($granted + $denied)) * 100)

: 0,

    ]);
}


}
