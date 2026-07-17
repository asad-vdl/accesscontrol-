@extends('layouts.app')

@section('content')



<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            Live Hardware Status

        </h5>

    </div>

    <div class="card-body">

        <div class="row text-center">

            <div class="col-md-3">

                <h6 class="text-muted">Maglock</h6>

                <span id="maglock_status"
                      class="d-inline-flex align-items-center fw-bold">

                    Loading...

                </span>

            </div>

            <div class="col-md-3">

                <h6 class="text-muted">Relay</h6>

                <span id="relay_status"
                      class="d-inline-flex align-items-center fw-bold">

                    Loading...

                </span>

            </div>

            <div class="col-md-3">

                <h6 class="text-muted">Door</h6>

                <span id="door_status"
                      class="d-inline-flex align-items-center fw-bold">

                    Loading...

                </span>

            </div>

            <div class="col-md-3">

                <h6 class="text-muted">Buzzer</h6>

                <span id="buzzer_status"
                      class="d-inline-flex align-items-center fw-bold">

                    Loading...

                </span>

            </div>

        </div>

    </div>

</div>

<div class="d-flex justify-content-between align-items-center mb-4">


</div>

<div class="row">

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Total Users</h6>
            <h2 class="text-primary fw-bold" id="totalUsers">
    {{ $totalUsers }}
</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h6 class="text-muted">
                Total Gates
            </h6>

            <h2 class="text-primary fw-bold" id="totalGates">

                {{ $totalGates }}

            </h2>

        </div>

    </div>

</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Total Devices</h6>
            <h2 class="text-success fw-bold" id="totalDevices">
    {{ $totalDevices }}
</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Credentials</h6>
            <h2 class="text-warning fw-bold" id="totalCredentials">
    {{ $totalCredentials }}
</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Today's Access</h6>
            <h2 class="text-info fw-bold" id="todayAccessLogs">
    {{ $todayAccessLogs }}
</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Granted Access</h6>
            <h2 class="text-success fw-bold" id="grantedAccess">
    {{ $grantedAccess }}
</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Denied Access</h6>
            <h2 class="text-danger fw-bold" id="deniedAccess">
    {{ $deniedAccess }}
</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Online Devices</h6>
            <h2 class="text-success fw-bold" id="onlineDevices">
    {{ $onlineDevices }}
</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Offline Devices</h6>
           <h2 class="text-danger fw-bold" id="offlineDevices">
    {{ $offlineDevices }}
</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Active Users</h6>
            <h2 class="text-success fw-bold" id="activeUsers">
    {{ $activeUsers }}
</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="text-muted">Inactive Users</h6>
            <h2 class="text-secondary fw-bold" id="inactiveUsers">
    {{ $inactiveUsers }}
</h2>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h6 class="text-muted mb-3">
                Access Success Rate
            </h6>

            <div class="d-flex align-items-center">

                <h2 class="text-success fw-bold mb-0 me-3"
                    id="accessSuccessRate">

                    {{ $accessSuccessRate }}%

                </h2>

                <div class="progress flex-grow-1"
                     style="height:8px;">

                    <div
                        id="accessSuccessBar"
                        class="progress-bar bg-success"
                        style="width: {{ $accessSuccessRate }}%;">

                    </div>

                </div>

            </div>

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

                <td>{{ $log->created_at->format('d-M-Y h:i A') }}</td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="mt-3">
    {{ $recentLogs->links() }}
</div>

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

<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            Live Activity Feed

        </h5>

    </div>

    <div class="card-body p-0">

        <ul id="event_feed" class="list-group list-group-flush">

        </ul>

    </div>

</div>

<script>

async function loadHardwareStatus() {

    try {

        const response = await fetch("http://127.0.0.1:8001/hardware/status");
        const data = await response.json();

        const hw = data.hardware_status;

        function setStatus(id, value, activeValue, activeText, inactiveText) {

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

    } catch (error) {
        console.log("Hardware API error:", error);
    }
}

// auto refresh every 1 second
setInterval(loadHardwareStatus, 1000);

// initial load
loadHardwareStatus();

</script>

<script>

async function loadEvents() {

    try {

        const res = await fetch("http://127.0.0.1:8001/hardware/events");
        const data = await res.json();

        const feed = document.getElementById("event_feed");
        feed.innerHTML = "";

        data.events.forEach(ev => {

            const li = document.createElement("li");
            li.className = "list-group-item";

           li.innerHTML = `
<div class="d-flex justify-content-between align-items-center">

    <div>

        <span class="rounded-circle bg-success me-2"
              style="width:10px;height:10px;display:inline-block;"></span>

        ${ev.message}

    </div>

    <small class="text-muted">

        ${ev.time}

    </small>

</div>
`;

            feed.appendChild(li);
        });

    } catch (err) {
        console.log(err);
    }
}

setInterval(loadEvents, 1000);
loadEvents();

</script>

<script>

async function loadDashboardStats() {

    try {

        const response = await fetch("{{ route('dashboard.live-stats') }}");

        const data = await response.json();

        document.getElementById("totalUsers").textContent = data.totalUsers;

        document.getElementById("totalGates").textContent = data.totalGates;

        document.getElementById("totalDevices").textContent = data.totalDevices;

        document.getElementById("totalCredentials").textContent = data.totalCredentials;

        document.getElementById("todayAccessLogs").textContent = data.todayAccessLogs;

        document.getElementById("grantedAccess").textContent = data.grantedAccess;

        document.getElementById("deniedAccess").textContent = data.deniedAccess;

        document.getElementById("accessSuccessRate").textContent =
    data.accessSuccessRate + "%";

    document.getElementById("accessSuccessRate").textContent =
    data.accessSuccessRate + "%";

document.getElementById("accessSuccessBar").style.width =
    data.accessSuccessRate + "%";

        document.getElementById("onlineDevices").textContent = data.onlineDevices;

        document.getElementById("offlineDevices").textContent = data.offlineDevices;

        document.getElementById("activeUsers").textContent = data.activeUsers;

        document.getElementById("inactiveUsers").textContent = data.inactiveUsers;

    }

    catch(error){

        console.log("Dashboard Live Error:", error);

    }

}

// First Load
loadDashboardStats();

// Auto Refresh Every 5 Seconds
setInterval(loadDashboardStats, 5000);

</script>

@endsection
