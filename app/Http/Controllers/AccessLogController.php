<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;

class AccessLogController extends Controller
{

    public function index()
{
    $logs = AccessLog::with([
    'user',
    'device'
])
->latest()
->paginate(10);
    $totalLogs = AccessLog::count();

    $grantedLogs = AccessLog::where(
        'access_status',
        'granted'
    )->count();

    $deniedLogs = AccessLog::where(
        'access_status',
        'denied'
    )->count();

    $todayLogs = AccessLog::whereDate(
        'created_at',
        today()
    )->count();

    return view(
        'access_logs.index',
        compact(
            'logs',
            'totalLogs',
            'grantedLogs',
            'deniedLogs',
            'todayLogs'
        )
    );
}


}
