<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessLog;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
{
    $query = AccessLog::with(['user', 'device']);

    if ($request->filled('from_date')) {
        $query->whereDate('created_at', '>=', $request->from_date);
    }

    if ($request->filled('to_date')) {
        $query->whereDate('created_at', '<=', $request->to_date);
    }

    if ($request->filled('status')) {
        $query->where('access_status', $request->status);
    }

    $reports = $query->latest()->paginate(10);

    $totalAccess = $query->count();

    $grantedAccess = (clone $query)
        ->where('access_status', 'granted')
        ->count();

    $deniedAccess = (clone $query)
        ->where('access_status', 'denied')
        ->count();

    $successRate = $totalAccess > 0
        ? round(($grantedAccess / $totalAccess) * 100)
        : 0;

        $topUsers = User::select(
        'users.id',
        'users.name',
        DB::raw('COUNT(access_logs.id) as total_access')
    )
    ->leftJoin('access_logs', 'users.id', '=', 'access_logs.user_id')
    ->groupBy('users.id', 'users.name')
    ->orderByDesc('total_access')
    ->take(5)
    ->get();

    $accessTrend = AccessLog::select(
        DB::raw('DATE(created_at) as access_date'),
        DB::raw('COUNT(*) as total')
    )
    ->whereDate('created_at', '>=', Carbon::now()->subDays(6))
    ->groupBy('access_date')
    ->orderBy('access_date')
    ->get();

$chartLabels = $accessTrend
    ->pluck('access_date')
    ->map(fn($date) => Carbon::parse($date)->format('d M'));

$chartData = $accessTrend->pluck('total');

    return view('reports.index', compact(
        'reports',
        'totalAccess',
        'grantedAccess',
        'deniedAccess',
        'successRate',
        'topUsers',
        'chartLabels',
        'chartData'
    ));
}

public function exportCsv(Request $request)
{
    $query = AccessLog::with(['user', 'device.gate']);

    if ($request->filled('from_date')) {
        $query->whereDate('created_at', '>=', $request->from_date);
    }

    if ($request->filled('to_date')) {
        $query->whereDate('created_at', '<=', $request->to_date);
    }

    if ($request->filled('status')) {
        $query->where('access_status', $request->status);
    }

    $reports = $query->latest()->get();

    return response()->streamDownload(function () use ($reports) {

        $handle = fopen('php://output', 'w');

        // CSV Headings
        fputcsv($handle, [
            'Date & Time',
            'User',
            'Device',
            'Gate',
            'Credential Type',
            'Credential Value',
            'Status',
            'Remarks'
        ]);

        // Data
        foreach ($reports as $report) {

            fputcsv($handle, [

                $report->created_at->format('d-M-Y h:i A'),

                $report->user->name ?? '-',

                $report->device->name ?? '-',

                $report->device->gate->name ?? '-',

                ucfirst($report->credential_type),

                $report->credential_value,

                ucfirst($report->access_status),

                $report->remarks

            ]);

        }

        fclose($handle);

    }, 'Access_Report_' . now()->format('Ymd_His') . '.csv');
}

}