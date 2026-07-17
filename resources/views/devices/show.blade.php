@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">

              

                Device Details

            </h3>

        
        </div>

        <div>

           <a href="{{ route('devices.index') }}"
   class="btn btn-outline-dark rounded-pill px-4 py-2 fw-semibold shadow-sm">

    <i class="bi bi-arrow-left me-2"></i>
    Back

</a>


<a href="{{ route('devices.edit',$device->id) }}"
   class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">

    <i class="bi bi-pencil-square me-2"></i>
    Edit Device

</a>

        </div>

    </div>

    <div class="row mb-4">

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Total Logs

                    </h6>

                    <h2 class="fw-bold text-primary">

                        {{ $totalLogs }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Granted Access

                    </h6>

                    <h2 class="fw-bold text-success">

                        {{ $grantedLogs }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Denied Access

                    </h6>

                    <h2 class="fw-bold text-danger">

                        {{ $deniedLogs }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Today's Activity

                    </h6>

                    <h2 class="fw-bold text-info">

                        {{ $todayLogs }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card border-0 shadow-lg rounded-4 mb-4">

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white">

    <h5 class="mb-0">

        Device Information

    </h5>

</div>
    </div>

    <div class="card-body">

        <div class="row">

            <!-- LEFT SIDE -->

            <div class="col-lg-4 text-center border-end">

                <div class="mb-3">

                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center shadow-sm"
                         style="width:140px;height:140px;">

                        <i class="bi bi-cpu-fill text-primary"
                           style="font-size:70px;"></i>

                    </div>

                </div>

                <h4 class="fw-bold">

                    {{ $device->name }}

                </h4>

                <p class="text-muted">

                    {{ ucfirst($device->type) }}

                </p>

                @if($device->online_status)

                    <span class="badge bg-success px-3 py-2">

                        <i class="bi bi-wifi me-1"></i>

                        Online

                    </span>

                @else

                    <span class="badge bg-danger px-3 py-2">

                        <i class="bi bi-wifi-off me-1"></i>

                        Offline

                    </span>

                @endif

            </div>

            <!-- RIGHT SIDE -->

            <div class="col-lg-8">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="text-muted small">

                            Device Code

                        </label>

                        <div class="fw-semibold">

                            {{ $device->device_code }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="text-muted small">

                            Device Type

                        </label>

                        <div class="fw-semibold">

                            {{ ucfirst($device->type) }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="text-muted small">

                            Assigned Gate

                        </label>

                        <div class="fw-semibold">

                            {{ $device->gate->name ?? 'Not Assigned' }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="text-muted small">

                            IP Address

                        </label>

                        <div class="fw-semibold">

                            {{ $device->ip_address ?? '-' }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="text-muted small">

                            Location

                        </label>

                        <div class="fw-semibold">

                            {{ $device->location ?? '-' }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="text-muted small">

                            Device Status

                        </label>

                       <div>

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

</div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="text-muted small">

                            Last Seen

                        </label>

                        <div class="fw-semibold">

                            {{ $device->last_seen ? $device->last_seen->format('d-M-Y h:i A') : 'Never' }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="text-muted small">

                            API Token

                        </label>

                        <div>

                            <code>

                                **************{{ substr($device->api_token,-8) }}

                            </code>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-people-fill text-primary me-2"></i>

            Assigned Users

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Photo</th>

                        <th>Name</th>

                        <th>Employee ID</th>

                        <th>Role</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                   @forelse($assignedUsers as $user)

                        <tr>

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
                                         class="rounded-circle">

                                @endif

                            </td>

                            <td>

                                <strong>{{ $user->name }}</strong>

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
                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
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

                        <th>Date & Time</th>

                        <th>User</th>

                        <th>Credential</th>

                        <th>Status</th>

                        <th>Remarks</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($device->accessLogs->sortByDesc('created_at')->take(10) as $log)

                        <tr>

                            <td>

                                {{ $log->created_at->format('d-M-Y h:i A') }}

                            </td>

                            <td>

                                {{ $log->user->name ?? 'Unknown User' }}

                            </td>

                            <td>

                                <span class="badge bg-secondary">

                                    {{ ucfirst($log->credential_type) }}

                                </span>

                                <br>

                                <small class="text-muted">

                                    {{ $log->credential_value }}

                                </small>

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

                                {{ $log->remarks ?? '-' }}

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



<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-broadcast text-primary me-2"></i>

            Live Device Status

        </h5>

    </div>

    <div class="card-body">

        <div class="row text-center">

            <div class="col-md-3 mb-3">

                <h6 class="text-muted">

                    Maglock

                </h6>

                <span id="maglock_status">

                    Loading...

                </span>

            </div>

            <div class="col-md-3 mb-3">

                <h6 class="text-muted">

                    Relay

                </h6>

                <span id="relay_status">

                    Loading...

                </span>

            </div>

            <div class="col-md-3 mb-3">

                <h6 class="text-muted">

                    Door

                </h6>

                <span id="door_status">

                    Loading...

                </span>

            </div>

            <div class="col-md-3 mb-3">

                <h6 class="text-muted">

                    Buzzer

                </h6>

                <span id="buzzer_status">

                    Loading...

                </span>

            </div>

        </div>

    </div>

</div>

<script>

async function loadHardwareStatus()
{

    try
    {

        const response = await fetch("http://127.0.0.1:8001/hardware/status");

        const data = await response.json();

        const hw = data.hardware_status;

        function setStatus(id, value, activeValue, activeText, inactiveText)
        {

            const el = document.getElementById(id);

            const active = value === activeValue;

            el.innerHTML = `

                <span class="rounded-circle ${active ? 'bg-success' : 'bg-danger'} me-2"
                      style="width:10px;height:10px;display:inline-block;">
                </span>

                ${active ? activeText : inactiveText}

            `;

        }

        setStatus("maglock_status", hw.maglock, "RELEASED", "Unlocked", "Locked");

        setStatus("relay_status", hw.relay, "ON", "ON", "OFF");

        setStatus("door_status", hw.door, "OPEN", "Open", "Closed");

        setStatus("buzzer_status", hw.buzzer, "ON", "ON", "OFF");

    }

    catch(error)
    {

        console.log(error);

    }

}

loadHardwareStatus();

setInterval(loadHardwareStatus,1000);

</script>

@endsection