@extends('layouts.app')

@section('content')

<div class="container-fluid">


    <a href="{{ route('devices.create') }}" class="btn btn-primary mb-4">
       Add Device
    </a>

</div>

@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif

<div class="row mb-4">

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Devices</h6>
                <h2 class="text-primary fw-bold">
                    {{ $totalDevices }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Active Devices</h6>
                <h2 class="text-success fw-bold">
                    {{ $activeDevices }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Online Devices</h6>
                <h2 class="text-info fw-bold">
                    {{ $onlineDevices }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Offline Devices</h6>
                <h2 class="text-danger fw-bold">
                    {{ $offlineDevices }}
                </h2>
            </div>
        </div>
    </div>

</div>

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">
        <h5 class="mb-0">
            Device Inventory
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
                        <th>Code</th>
                        <th>IP Address</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Online</th>
                        <th>Last Seen</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($devices as $device)

                    <tr>

                        <td>{{ $device->id }}</td>

                        <td>
                            <strong>{{ $device->name }}</strong>
                        </td>

                        <td>{{ $device->type }}</td>

                        <td>{{ $device->device_code }}</td>

                        <td>{{ $device->ip_address ?? '-' }}</td>

                        <td>{{ $device->location ?? '-' }}</td>

                        <td>

                            @if($device->status)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Inactive
                                </span>

                            @endif

                        </td>

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

                        <td>

                            <a href="{{ route('devices.edit',$device->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('devices.destroy',$device->id) }}"
                                  method="POST"
                                  style="display:inline-block;">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete Device?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="10" class="text-center py-4">
                            No Devices Found
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
