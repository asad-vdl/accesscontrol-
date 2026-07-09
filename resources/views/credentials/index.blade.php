@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <a href="{{ route('credentials.create') }}"
           class="btn btn-primary">

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
                        <td>

                        @if($credential->user && $credential->user->gates->count())

                            @foreach($credential->user->gates as $gate)

                                @if($gate->pivot->access_allowed)

                                    <span class="badge bg-white text-success mb-1 me-2 px-2 py-2">

                                        <i class="bi bi-check-circle-fill"></i>

                                        {{ $gate->name }}

                                    </span>

                                @else

                                    <span class="badge bg-white text-danger mb-1 me-2 px-2 py-2">

                                        <i class="bi bi-x-circle-fill"></i>

                                        {{ $gate->name }}

                                    </span>

                                @endif

                            @endforeach

                        @else

                            <span class="badge bg-white text-secondary">

                                No Gate Assigned

                            </span>

                        @endif

                        </td>
                        <td>

                                @if($credential->status)

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

                                <a href="{{ route('credentials.edit', $credential->id) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route('credentials.destroy', $credential->id) }}"
                                      method="POST"
                                      style="display:inline-block;">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete Credential?')">

                                        Delete

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