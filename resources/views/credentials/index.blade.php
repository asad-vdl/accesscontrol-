@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

       <a href="{{ route('credentials.create') }}"
   class="btn btn-primary mb-3">

    <i class="bi bi-plus-circle me-1"></i>

    Add Credential

</a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="row mb-4">

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Credentials
                    </h6>

                    <h2 class="text-primary fw-bold">
                        {{ $totalCredentials }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="text-muted">
                        Active Credentials
                    </h6>

                    <h2 class="text-success fw-bold">
                        {{ $activeCredentials }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="text-muted">
                        Inactive Credentials
                    </h6>

                    <h2 class="text-danger fw-bold">
                        {{ $inactiveCredentials }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Credentials List
            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>ID</th>

                            <th>User</th>

                            <th>Credential Type</th>

                            <th>Credential Value</th>

                            <th>Allowed Gates</th>

                            <th>Status</th>

                            <th width="180">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($credentials as $credential)

                        <tr>

                            <td>
                                {{ $credential->id }}
                            </td>

                            <td>
                                <strong>
                                    {{ $credential->user->name ?? 'N/A' }}
                                </strong>
                            </td>

                            <td>

                                <span class="badge bg-info">

                                    {{ ucfirst($credential->credential_type) }}

                                </span>

                            </td>

                            <td>

                                <code>
                                    {{ $credential->credential_value }}
                                </code>

                            </td>
                       <td style="min-width:220px;">

@if($credential->user && $credential->user->gates->count())

<button
    class="btn btn-sm btn-outline-primary"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#gate{{ $credential->id }}"
    aria-expanded="false">

    <i class="bi bi-door-open"></i>

    {{ $credential->user->gates->count() }}

    Gate(s)

    <i class="bi bi-chevron-down ms-1"></i>

</button>


<div class="collapse mt-2" id="gate{{ $credential->id }}">

    @foreach($credential->user->gates as $gate)

        <div class="border rounded p-2 mb-2 bg-light">

            <div class="fw-bold text-success mb-2">

                <i class="bi bi-door-open-fill"></i>

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

    @endforeach

</div>

@else

<span class="badge bg-secondary">

    No Gate Assigned

</span>

@endif

</td>
                       <td>

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

</td>

                            <td>

                                 <a href="{{ route('credentials.show', $credential->id) }}"
           class="btn btn-light btn-sm border"
           title="View Credential">

            <i class="bi bi-eye text-success"></i>

        </a>


    <a href="{{ route('credentials.edit',$credential->id) }}"
       class="btn btn-light btn-sm border me-1"
       title="Edit Credential">

        <i class="bi bi-pencil-square text-primary"></i>

    </a>

    <form action="{{ route('credentials.destroy',$credential->id) }}"
          method="POST"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="btn btn-light btn-sm border"
            title="Delete Credential"
            onclick="return confirm('Delete this credential?')">

            <i class="bi bi-trash text-danger"></i>

        </button>

    </form>

</td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-4">

                                No Credentials Found

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