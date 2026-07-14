@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

       

    </div>

    <div class="row mb-4">

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Logs
                    </h6>

                    <h2 class="text-primary fw-bold">
                        {{ $totalLogs }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

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

        <div class="col-md-3 mb-3">

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

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="text-muted">
                        Today's Activity
                    </h6>

                    <h2 class="text-info fw-bold">
                        {{ $todayLogs }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Access Activity History
            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>ID</th>
                            <th>User</th>
                            <th>Device</th>
                            <th>Credential Type</th>
                            <th>Credential Value</th>
                            <th>Status</th>
                            <th>Date & Time</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($logs as $log)

                        <tr>

                            <td>
                                {{ $log->id }}
                            </td>

                            <td>

                                <strong>
                                    {{ $log->user->name ?? 'Unknown User' }}
                                </strong>

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

                                <code>

                                    {{ $log->credential_value }}

                                </code>

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

                                {{ $log->created_at->format('d-M-Y h:i:s A') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-4">

                                No Access Logs Found

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

                <div class="mt-3">
    {{ $logs->links() }}
</div>

            </div>

        </div>

    </div>

</div>

@endsection