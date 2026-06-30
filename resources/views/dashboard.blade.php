@extends('layouts.app')

@section('content')



<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-dark text-white">
        ⚡ Live Hardware Status (Real-Time)
    </div>

    <div class="card-body">

        <div class="row text-center">

            <div class="col-md-3">
                <h6>🧲 Maglock</h6>
                <h4 id="maglock_status" class="text-danger">LOADING...</h4>
            </div>

            <div class="col-md-3">
                <h6>⚡ Relay</h6>
                <h4 id="relay_status" class="text-secondary">LOADING...</h4>
            </div>

            <div class="col-md-3">
                <h6>🚪 Door</h6>
                <h4 id="door_status" class="text-primary">LOADING...</h4>
            </div>

            <div class="col-md-3">
                <h6>🔔 Buzzer</h6>
                <h4 id="buzzer_status" class="text-warning">LOADING...</h4>
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

<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-dark text-white">
        🔥 Live Activity Feed
    </div>

    <div class="card-body">
        <ul id="event_feed" class="list-group"></ul>
    </div>
</div>

<script>

async function loadHardwareStatus() {

    try {

        const response = await fetch("http://127.0.0.1:8001/hardware/status");
        const data = await response.json();

        const hw = data.hardware_status;

        // Maglock
        document.getElementById("maglock_status").innerText = hw.maglock;

        // Relay
        document.getElementById("relay_status").innerText = hw.relay;

        // Door
        document.getElementById("door_status").innerText = hw.door;

        // Buzzer
        document.getElementById("buzzer_status").innerText = hw.buzzer;

        // Colors (dynamic)
        document.getElementById("maglock_status").style.color =
            hw.maglock === "LOCKED" ? "red" : "green";

        document.getElementById("relay_status").style.color =
            hw.relay === "ON" ? "green" : "gray";

        document.getElementById("door_status").style.color =
            hw.door === "OPEN" ? "green" : "blue";

        document.getElementById("buzzer_status").style.color =
            hw.buzzer === "OFF" ? "gray" : "orange";

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
                <b>[${ev.time}]</b> ${ev.message}
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

@endsection
