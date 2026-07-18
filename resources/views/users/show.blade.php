@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">

               

                User Details

            </h3>


        </div>

        <div>

           <a href="{{ route('users.index') }}"
   class="btn btn-secondary rounded-pill px-4 py-2 fw-semibold shadow-sm">

    <i class="bi bi-arrow-left me-2"></i>
    Back

</a>


<a href="{{ route('users.edit',$user->id) }}"
   class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">

    <i class="bi bi-pencil-square me-2"></i>
    Edit User

</a>

        </div>

    </div>



    <div class="row mb-4">

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Credentials

                    </h6>

                    <h2 class="fw-bold text-primary">

                        {{ $totalCredentials }}

                    </h2>

                </div>

            </div>

        </div>



        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Gates

                    </h6>

                    <h2 class="fw-bold text-success">

                        {{ $totalGates }}

                    </h2>

                </div>

            </div>

        </div>



        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Devices

                    </h6>

                    <h2 class="fw-bold text-info">

                        {{ $totalDevices }}

                    </h2>

                </div>

            </div>

        </div>



        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

               <div class="card-body text-center py-4">

                    <h6 class="text-muted">

                        Status

                    </h6>

                    @if($user->status)

<span class="d-inline-flex align-items-center mt-2">

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

    </div>



    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">

               

                User Information

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-lg-3 text-center">

                    @if($user->photo)

    <img src="{{ asset('storage/'.$user->photo) }}"
         class="rounded-circle shadow border"
         width="170"
         height="170"
         style="object-fit:cover;">

@else

    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D6EFD&color=fff&size=170"
         class="rounded-circle shadow border"
         width="170"
         height="170">

@endif

<h4 class="mt-3 mb-1 fw-bold">

    {{ $user->name }}

</h4>

<p class="text-muted">

    {{ ucfirst($user->role) }}

</p>

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

</div>

<div class="col-lg-9">

    <div class="row">

        <div class="col-md-6 mb-3">

            <label class="text-muted fw-semibold">

                Full Name

            </label>

            <div class="form-control bg-light">

                {{ $user->name }}

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <label class="text-muted fw-semibold">

                Email Address

            </label>

            <div class="form-control bg-light">

                {{ $user->email }}

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <label class="text-muted fw-semibold">

                Phone Number

            </label>

            <div class="form-control bg-light">

                {{ $user->phone ?: '-' }}

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <label class="text-muted fw-semibold">

                Employee ID

            </label>

            <div class="form-control bg-light">

                {{ $user->employee_id ?: '-' }}

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <label class="text-muted fw-semibold">

                Role

            </label>

            <div class="form-control bg-light">

                {{ ucfirst($user->role) }}

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <label class="text-muted fw-semibold">

                Account Status

            </label>

            <div class="form-control bg-light">

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

            </div>

        </div>

    </div>

</div>

</div>

</div>

</div>
<div class="row mt-4">

    <!-- Credentials -->

    <div class="col-lg-4 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    <i class="bi bi-credit-card-2-front-fill text-primary me-2"></i>

                    Credentials

                </h5>

            </div>

            <div class="card-body">

                @forelse($user->credentials as $credential)

                    <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">

                        <div>

                            <div class="fw-bold">

                                {{ ucfirst($credential->type) }}

                            </div>

                            <small class="text-muted">

                                {{ $credential->credential_value }}

                            </small>

                        </div>

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

                @empty

                    <div class="text-center text-muted py-4">

                        <i class="bi bi-credit-card display-6"></i>

                        <p class="mt-2 mb-0">

                            No Credentials Assigned

                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>



    <!-- Gates & Devices -->

    <div class="col-lg-4 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    <i class="bi bi-door-open-fill text-success me-2"></i>

                    Assigned Gates

                </h5>

            </div>

            <div class="card-body">

                @forelse($user->gates as $gate)

                    <div class="border rounded p-3 mb-3">

                        <div class="fw-bold text-success mb-2">

                            <i class="bi bi-door-open-fill me-1"></i>

                            {{ $gate->name }}

                        </div>

                        @forelse($gate->devices as $device)

                            <span class="badge bg-primary me-1 mb-1">

                                <i class="bi bi-cpu-fill me-1"></i>

                                {{ $device->name }}

                            </span>

                        @empty

                            <span class="badge bg-danger">

                                No Device

                            </span>

                        @endforelse

                    </div>

                @empty

                    <div class="text-center text-muted py-4">

                        <i class="bi bi-door-closed display-6"></i>

                        <p class="mt-2 mb-0">

                            No Gate Assigned

                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>



    <!-- Access Schedule -->

    <div class="col-lg-4 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    <i class="bi bi-calendar-week-fill text-warning me-2"></i>

                    Access Schedule

                </h5>

            </div>

            <div class="card-body">

                @if($user->accessSchedule)

                    <table class="table table-borderless table-sm">

                        <tr>

                            <th>Time</th>

                            <td>

                                {{ \Carbon\Carbon::parse($user->accessSchedule->start_time)->format('H:i') }}

                                -

                                {{ \Carbon\Carbon::parse($user->accessSchedule->end_time)->format('H:i') }}

                            </td>

                        </tr>

                        <tr>

                            <th>Valid From</th>

                            <td>

                                {{ $user->accessSchedule->valid_from ?? '-' }}

                            </td>

                        </tr>

                        <tr>

                            <th>Valid To</th>

                            <td>

                                {{ $user->accessSchedule->valid_to ?? '-' }}

                            </td>

                        </tr>

                        <tr>

                            <th>Status</th>

                            <td>

                                @if($user->accessSchedule->status)

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

                    </table>

                @else

                    <div class="text-center text-muted py-4">

                        <i class="bi bi-calendar-x display-6"></i>

                        <p class="mt-2 mb-0">

                            No Schedule Available

                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>
<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            <i class="bi bi-clock-history text-primary me-2"></i>

            Recent Access Logs

        </h5>

        <span class="badge bg-primary">

            {{ $user->accessLogs->count() }}

            Logs

        </span>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Date & Time</th>

                        <th>Device</th>

                        <th>Credential</th>

                        <th>Result</th>

                        <th>Remarks</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($user->accessLogs->sortByDesc('created_at')->take(10) as $log)

                    <tr>

                        <td>

                            {{ $log->created_at->format('d M Y') }}

                            <br>

                            <small class="text-muted">

                                {{ $log->created_at->format('h:i A') }}

                            </small>

                        </td>

                        <td>

                            {{ $log->device->name ?? '-' }}

                        </td>

                        <td>

                            {{ ucfirst($log->credential_type) }}

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

                        <td colspan="5" class="text-center py-5 text-muted">

                            <i class="bi bi-clock-history display-5"></i>

                            <br><br>

                            No Access Logs Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<div class="mt-4 text-end">

    <a href="{{ route('users.index') }}"
       class="btn btn-outline-secondary">

        <i class="bi bi-arrow-left-circle me-1"></i>

        Back to Users

    </a>

    <a href="{{ route('users.edit',$user->id) }}"
       class="btn btn-primary">

        <i class="bi bi-pencil-square me-1"></i>

        Edit User

    </a>

</div>

@endsection