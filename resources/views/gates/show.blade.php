@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="row mb-4">

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="text-muted">

                    Total Devices

                </h6>

                <h2 class="text-primary fw-bold">

                    {{ $totalDevices }}

                </h2>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="text-muted">

                    Assigned Users

                </h6>

                <h2 class="text-success fw-bold">

                    {{ $totalUsers }}

                </h2>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="text-muted">

                    Credentials

                </h6>

                <h2 class="text-warning fw-bold">

                    {{ $totalCredentials }}

                </h2>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="text-muted">

                    Today's Access

                </h6>

                <h2 class="text-info fw-bold">

                    {{ $todayLogs }}

                </h2>

            </div>

        </div>

    </div>

</div>
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-door-open-fill text-primary me-2"></i>

            Gate Information

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label text-muted">

                    Gate Name

                </label>

                <div class="fw-bold">

                    {{ $gate->name }}

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label text-muted">

                    Gate Code

                </label>

                <div>

                    <span class="badge bg-primary">

                        {{ $gate->gate_code }}

                    </span>

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label text-muted">

                    Location

                </label>

                <div>

                    {{ $gate->location ?? 'N/A' }}

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label text-muted">

                    Status

                </label>

                <div>

                    @if($gate->status)

                        <span class="d-inline-flex align-items-center">

                            <span class="rounded-circle bg-success me-2"
                                  style="width:10px;height:10px;"></span>

                            Active

                        </span>

                    @else

                        <span class="d-inline-flex align-items-center">

                            <span class="rounded-circle bg-danger me-2"
                                  style="width:10px;height:10px;"></span>

                            Inactive

                        </span>

                    @endif

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label text-muted">

                    Created Date

                </label>

                <div>

                    {{ $gate->created_at->format('d-M-Y h:i A') }}

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label text-muted">

                    Last Updated

                </label>

                <div>

                    {{ $gate->updated_at->format('d-M-Y h:i A') }}

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-cpu-fill text-primary me-2"></i>

            Assigned Devices

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>ID</th>

                        <th>Device Name</th>

                        <th>Type</th>

                        <th>Device Code</th>

                        <th>Enabled</th>

                        <th>Connection</th>

                        <th width="80">View</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($gate->devices as $device)

                    <tr>

                        <td>

                            {{ $device->id }}

                        </td>

                        <td>

                            <strong>

                                {{ $device->name }}

                            </strong>

                        </td>

                        <td>

                            {{ $device->type }}

                        </td>

                        <td>

                            <code>

                                {{ $device->device_code }}

                            </code>

                        </td>

                        <td>

                            @if($device->status)

                                <span class="d-inline-flex align-items-center">

                                    <span class="rounded-circle bg-success me-2"
                                          style="width:10px;height:10px;"></span>

                                    Enabled

                                </span>

                            @else

                                <span class="d-inline-flex align-items-center">

                                    <span class="rounded-circle bg-danger me-2"
                                          style="width:10px;height:10px;"></span>

                                    Disabled

                                </span>

                            @endif

                        </td>

                        <td>

                            @if($device->online_status)

                                <span class="d-inline-flex align-items-center">

                                    <span class="rounded-circle bg-success me-2"
                                          style="width:10px;height:10px;"></span>

                                    Online

                                </span>

                            @else

                                <span class="d-inline-flex align-items-center">

                                    <span class="rounded-circle bg-danger me-2"
                                          style="width:10px;height:10px;"></span>

                                    Offline

                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('devices.show', $device->id) }}"
                               class="btn btn-light btn-sm border"
                               title="View Device">

                                <i class="bi bi-eye text-success"></i>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-4">

                            No Devices Assigned

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-people-fill text-primary me-2"></i>

            Authorized Users

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>ID</th>

                        <th>Photo</th>

                        <th>Name</th>

                        <th>Employee ID</th>

                        <th>Role</th>

                        <th>Status</th>

                        <th width="80">

                            View

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($gate->users as $user)

                    <tr>

                        <td>

                            {{ $user->id }}

                        </td>

                        <td>

                            @if($user->photo)

                                <img src="{{ asset('storage/'.$user->photo) }}"
                                     width="45"
                                     height="45"
                                     class="rounded-circle border"
                                     style="object-fit:cover;">

                            @else

                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0d6efd&color=ffffff"
                                     width="45"
                                     height="45"
                                     class="rounded-circle">

                            @endif

                        </td>

                        <td>

                            <strong>

                                {{ $user->name }}

                            </strong>

                        </td>

                        <td>

                            {{ $user->employee_id ?? '-' }}

                        </td>

                        <td>

                            <span class="badge bg-secondary">

                                {{ ucfirst($user->role) }}

                            </span>

                        </td>

                        <td>

                            @if($user->status)

                                <span class="d-inline-flex align-items-center">

                                    <span class="rounded-circle bg-success me-2"
                                          style="width:10px;height:10px;"></span>

                                    Active

                                </span>

                            @else

                                <span class="d-inline-flex align-items-center">

                                    <span class="rounded-circle bg-danger me-2"
                                          style="width:10px;height:10px;"></span>

                                    Inactive

                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('users.show',$user->id) }}"
                               class="btn btn-light btn-sm border"
                               title="View User">

                                <i class="bi bi-eye text-success"></i>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-4">

                            No Users Assigned

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-clock-history text-primary me-2"></i>

            Recent Access Logs

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>User</th>

                        <th>Device</th>

                        <th>Credential</th>

                        <th>Status</th>

                        <th>Date & Time</th>

                    </tr>

                </thead>

                <tbody>

                @php

                    $logs = $gate->devices
                        ->flatMap->accessLogs
                        ->sortByDesc('created_at')
                        ->take(10);

                @endphp

                @forelse($logs as $log)

                    <tr>

                        <td>

                            {{ $log->user->name ?? 'Unknown User' }}

                        </td>

                        <td>

                            {{ $log->device->name ?? 'N/A' }}

                        </td>

                        <td>

                            <span class="badge bg-secondary">

                                {{ ucfirst($log->credential_type) }}

                            </span>

                        </td>

                        <td>

                            @if($log->access_status == 'granted')

                                <span class="badge bg-success">

                                    <i class="bi bi-check-circle-fill me-1"></i>

                                    Granted

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    <i class="bi bi-x-circle-fill me-1"></i>

                                    Denied

                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $log->created_at->format('d-M-Y h:i A') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="text-center py-4">

                            No Access Logs Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

@endsection