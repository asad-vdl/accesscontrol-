@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Reports
            </h3>

            <p class="text-muted mb-0">
                Access Control Reports & Analytics
            </p>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Total Access
                    </h6>

                    <h2 class="fw-bold text-primary">
                       {{ $totalAccess }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Granted
                    </h6>

                    <h2 class="fw-bold text-success">
                        {{ $grantedAccess }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Denied
                    </h6>

                    <h2 class="fw-bold text-danger">
                        {{ $deniedAccess }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Success Rate
                    </h6>

                    <h2 class="fw-bold text-info">
                        {{ $successRate }}%
                    </h2>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-trophy text-warning me-2"></i>

            Top 5 Active Users

        </h5>

    </div>

    <div class="card-body">

        <table class="table table-hover align-middle">

            <thead class="table-light">

                <tr>

                    <th>#</th>

                    <th>User</th>

                    <th>Total Access</th>

                </tr>

            </thead>

            <tbody>

                @forelse($topUsers as $index => $user)

                    <tr>

                        <td>{{ $index + 1 }}</td>

                        <td>{{ $user->name }}</td>

                        <td>

                            <span class="badge bg-primary">

                                {{ $user->total_access }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3"
                            class="text-center">

                            No Data Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-graph-up-arrow text-primary me-2"></i>

            Access Trend (Last 7 Days)

        </h5>

    </div>

    <div class="card-body">

        <canvas id="accessTrendChart" height="90"></canvas>

    </div>

</div>


<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-pie-chart-fill text-success me-2"></i>

            Granted vs Denied

        </h5>

    </div>

    <div class="card-body text-center">

    <div style="width:280px; height:280px; margin:auto;">

        <canvas id="accessStatusChart"></canvas>

    </div>

</div>

</div>

<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-funnel me-2 text-primary"></i>

            Report Filters

        </h5>

    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('reports.index') }}">

            <div class="row">

                <div class="col-md-3 mb-3">

                    <label class="form-label">From Date</label>

                    <input type="date"
                           name="from_date"
                           class="form-control">

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">To Date</label>

                    <input type="date"
                           name="to_date"
                           class="form-control">

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">Status</label>

                    <select name="status"
                            class="form-select">

                        <option value="">All</option>

                        <option value="granted">Granted</option>

                        <option value="denied">Denied</option>

                    </select>

                </div>

                <div class="col-md-3 d-flex align-items-end mb-3">

    <div class="d-flex gap-2 w-100">

        <button type="submit" class="btn btn-primary flex-fill">

            <i class="bi bi-search me-2"></i>

            Generate

        </button>

        <a href="{{ route('reports.export.csv', request()->query()) }}"
           class="btn btn-success flex-fill">

            <i class="bi bi-file-earmark-spreadsheet me-2"></i>

            Export

        </a>

    </div>

</div>
                    

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-file-earmark-bar-graph text-primary me-2"></i>

            Access Report

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Date & Time</th>
                        <th>User</th>
                        <th>Device</th>
                        <th>Gate</th>
                        <th>Credential</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($reports as $report)

                        <tr>

                            <td>
                                {{ $report->created_at->format('d-M-Y h:i A') }}
                            </td>

                            <td>
                                {{ $report->user->name ?? 'Unknown User' }}
                            </td>

                            <td>
                                {{ $report->device->name ?? '-' }}
                            </td>

                            <td>
                                {{ $report->device->gate->name ?? '-' }}
                            </td>

                            <td>

                                <span class="badge bg-secondary">

                                    {{ ucfirst($report->credential_type) }}

                                </span>

                                <br>

                                <small class="text-muted">

                                    {{ $report->credential_value }}

                                </small>

                            </td>

                            <td>

                                @if($report->access_status == 'granted')

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

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-4">

                                No Report Data Found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $reports->withQueryString()->links() }}

        </div>

    </div>

</div>

<script>

const ctx = document.getElementById('accessTrendChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: @json($chartLabels),

        datasets: [{

            label: 'Access',

            data: @json($chartData),

            borderColor: '#0d6efd',

            backgroundColor: 'rgba(13,110,253,0.15)',

            fill: true,

            tension: 0.4

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                display: false

            }

        }

    }

});

const statusCtx = document.getElementById('accessStatusChart');

new Chart(statusCtx, {

    type: 'doughnut',

    data: {

        labels: ['Granted', 'Denied'],

        datasets: [{

            data: [{{ $grantedAccess }}, {{ $deniedAccess }}],

            backgroundColor: [

                '#198754',

                '#dc3545'

            ],

            borderWidth: 1

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                position: 'bottom'

            }

        }

    }

});

</script>

@endsection