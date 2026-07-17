@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="row mb-4">

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="text-muted">

                    Total Access Logs

                </h6>

                <h2 class="text-primary fw-bold">

                    {{ $totalLogs }}

                </h2>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="text-muted">

                    Granted Access

                </h6>

                <h2 class="text-success fw-bold">

                    {{ $grantedLogs }}

                </h2>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="text-muted">

                    Denied Access

                </h6>

                <h2 class="text-danger fw-bold">

                    {{ $deniedLogs }}

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

            <i class="bi bi-key-fill text-primary me-2"></i>

            Credential Information

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label text-muted">

                    Credential Type

                </label>

                <div>

                    <span class="badge bg-primary">

                        {{ ucfirst($credential->credential_type) }}

                    </span>

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label text-muted">

                    Credential Value

                </label>

                <div>

                    <code>

                        {{ $credential->credential_value }}

                    </code>

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label text-muted">

                    Status

                </label>

                <div>

                    @if($credential->status)

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

                    Assigned User

                </label>

                <div>

                    {{ $credential->user->name ?? 'N/A' }}

                </div>

            </div>

            <div class="col-md-12 mb-3">

                <label class="form-label text-muted">

                    Notes

                </label>

                <div>

                    {{ $credential->notes ?: 'No Notes Available' }}

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label text-muted">

                    Created Date

                </label>

                <div>

                    {{ $credential->created_at->format('d-M-Y h:i A') }}

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label text-muted">

                    Last Updated

                </label>

                <div>

                    {{ $credential->updated_at->format('d-M-Y h:i A') }}

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-person-fill text-primary me-2"></i>

            Assigned User

        </h5>

    </div>

    <div class="card-body">

        <div class="row align-items-center">

            <div class="col-md-2 text-center mb-3">

                @if($credential->user->photo)

                    <img src="{{ asset('storage/'.$credential->user->photo) }}"
                         class="rounded-circle border"
                         width="120"
                         height="120"
                         style="object-fit:cover;">

                @else

                    <img src="https://ui-avatars.com/api/?name={{ urlencode($credential->user->name) }}&background=0d6efd&color=ffffff&size=120"
                         class="rounded-circle border">

                @endif

            </div>

            <div class="col-md-10">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label text-muted">

                            Full Name

                        </label>

                        <div>

                            <strong>

                                {{ $credential->user->name }}

                            </strong>

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label text-muted">

                            Employee ID

                        </label>

                        <div>

                            {{ $credential->user->employee_id ?? '-' }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label text-muted">

                            Email

                        </label>

                        <div>

                            {{ $credential->user->email }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label text-muted">

                            Phone

                        </label>

                        <div>

                            {{ $credential->user->phone ?? '-' }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label text-muted">

                            Role

                        </label>

                        <div>

                            <span class="badge bg-secondary">

                                {{ ucfirst($credential->user->role) }}

                            </span>

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label text-muted">

                            Status

                        </label>

                        <div>

                            @if($credential->user->status)

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

                </div>

                <a href="{{ route('users.show',$credential->user->id) }}"
                   class="btn btn-primary mt-2">

                    <i class="bi bi-eye me-1"></i>

                    View User Profile

                </a>

            </div>

        </div>

    </div>

</div>

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-door-open-fill text-primary me-2"></i>

            Allowed Gates

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>ID</th>

                        <th>Gate Name</th>

                        <th>Gate Code</th>

                        <th>Location</th>

                        <th>Devices</th>

                        <th>Status</th>

                        <th width="80">

                            View

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($credential->user->gates as $gate)

                    <tr>

                        <td>

                            {{ $gate->id }}

                        </td>

                        <td>

                            <strong>

                                {{ $gate->name }}

                            </strong>

                        </td>

                        <td>

                            <code>

                                {{ $gate->gate_code }}

                            </code>

                        </td>

                        <td>

                            {{ $gate->location ?? '-' }}

                        </td>

                        <td>

                            <span class="badge bg-primary">

                                {{ $gate->devices->count() }}

                                Device(s)

                            </span>

                        </td>

                        <td>

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

                        </td>

                        <td>

                            <a href="{{ route('gates.show',$gate->id) }}"
                               class="btn btn-light btn-sm border"
                               title="View Gate">

                                <i class="bi bi-eye text-success"></i>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-4">

                            No Gate Assigned

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

            Recent Access History

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>User</th>

                        <th>Device</th>

                        <th>Credential Type</th>

                        <th>Status</th>

                        <th>Date & Time</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($credential->accessLogs->sortByDesc('created_at')->take(10) as $log)

                    <tr>

                        <td>

                            {{ $log->user->name ?? 'Unknown User' }}

                        </td>

                        <td>

                            {{ $log->device->name ?? 'Unknown Device' }}

                        </td>

                        <td>

                            <span class="badge bg-secondary">

                                {{ ucfirst($log->credential_type) }}

                            </span>

                        </td>

                        <td>

                           @if($log->access_status == 'granted')

    <span class="d-inline-flex align-items-center">

        <span class="rounded-circle bg-success me-2"
              style="width:10px;height:10px;"></span>

        Granted

    </span>

@else

    <span class="d-inline-flex align-items-center">

        <span class="rounded-circle bg-danger me-2"
              style="width:10px;height:10px;"></span>

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

                            No Access History Found

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