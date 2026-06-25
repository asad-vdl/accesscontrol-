@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

<div>
    <h2 class="fw-bold mb-1">
        Dashboard
    </h2>

    <p class="text-muted mb-0">
        Smart Access Control System Overview
    </p>
</div>


</div>

<div class="row">

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Total Users</h6>
            <h2 class="text-primary fw-bold">{{ $totalUsers }}</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Total Devices</h6>
            <h2 class="text-success fw-bold">{{ $totalDevices }}</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Credentials</h6>
            <h2 class="text-warning fw-bold">{{ $totalCredentials }}</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Today's Access</h6>
            <h2 class="text-info fw-bold">{{ $todayAccessLogs }}</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Granted Access</h6>
            <h2 class="text-success fw-bold">{{ $grantedAccess }}</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Denied Access</h6>
            <h2 class="text-danger fw-bold">{{ $deniedAccess }}</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Online Devices</h6>
            <h2 class="text-success fw-bold">{{ $onlineDevices }}</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Offline Devices</h6>
            <h2 class="text-danger fw-bold">{{ $offlineDevices }}</h2>
        </div>
    </div>
</div>

<div class="col-lg-6 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Active Users</h6>
            <h2 class="text-success fw-bold">{{ $activeUsers }}</h2>
        </div>
    </div>
</div>

<div class="col-lg-6 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Inactive Users</h6>
            <h2 class="text-secondary fw-bold">{{ $inactiveUsers }}</h2>
        </div>
    </div>
</div>


</div>

<div class="card border-0 shadow-sm mt-4">

<div class="card-header bg-white">
    <h4 class="mb-0">
        Recent Access Logs
    </h4>
</div>

<div class="card-body">

    <table class="table table-hover align-middle">

        <thead class="table-light">

            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Device</th>
                <th>Status</th>
                <th>Date Time</th>
            </tr>

        </thead>

        <tbody>

            @foreach($recentLogs as $log)

            <tr>

                <td>{{ $log->id }}</td>

                <td>{{ $log->user->name ?? 'Unknown User' }}</td>

                <td>{{ $log->device->name ?? 'N/A' }}</td>

                <td>

                    @if($log->access_status == 'granted')

                        <span class="badge bg-success">
                            Granted
                        </span>

                    @else

                        <span class="badge bg-danger">
                            Denied
                        </span>

                    @endif

                </td>

                <td>{{ $log->created_at->format('d-M-Y h:i A') }}</td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

</div>

<div class="card border-0 shadow-sm mt-4">

<div class="card-header bg-white">
    <h4 class="mb-0">
        Device Health Monitor
    </h4>
</div>

<div class="card-body">

    <table class="table table-hover align-middle">

        <thead class="table-light">

            <tr>
                <th>ID</th>
                <th>Device Name</th>
                <th>Location</th>
                <th>Status</th>
                <th>Last Seen</th>
            </tr>

        </thead>

        <tbody>

            @foreach($devices as $device)

            <tr>

                <td>{{ $device->id }}</td>

                <td>{{ $device->name }}</td>

                <td>{{ $device->location ?? 'N/A' }}</td>

                <td>

                    @if($device->online_status)

                        <span class="badge bg-success">
                            Online
                        </span>

                    @else

                        <span class="badge bg-danger">
                            Offline
                        </span>

                    @endif

                </td>

                <td>

                    @if($device->last_seen)

                        {{ \Carbon\Carbon::parse($device->last_seen)->format('d-M-Y h:i A') }}

                    @else

                        Never

                    @endif

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

</div>

@endsection
