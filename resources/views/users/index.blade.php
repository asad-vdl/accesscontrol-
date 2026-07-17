
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

       <a href="{{ route('users.create') }}"
   class="btn btn-primary mb-3">

    <i class="bi bi-plus-circle me-1"></i>

    Add User

</a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="row mb-4">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Users
                    </h6>

                    <h2 class="text-primary fw-bold">
                        {{ $totalUsers }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="text-muted">
                        Active Users
                    </h6>

                    <h2 class="text-success fw-bold">
                        {{ $activeUsers }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="text-muted">
                        Inactive Users
                    </h6>

                    <h2 class="text-danger fw-bold">
                        {{ $inactiveUsers }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Users List
            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>ID</th>

                            <th>Photo</th>

                            <th>Name</th>

                            <th>Email</th>

                            

                            <th>Employee ID</th>

                            <th>Assigned Access</th>

                            <th>Status</th>

                            <th width="180">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                        <tr>

                            <td>
                                {{ $user->id }}
                            </td>

                            <td>

                                @if($user->photo)

                                    <img src="{{ asset('storage/'.$user->photo) }}"
                                         width="50"
                                         height="50"
                                         class="rounded-circle border"
                                         style="object-fit:cover;">

                                @else

                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0d6efd&color=ffffff"
                                         width="50"
                                         height="50"
                                         class="rounded-circle">

                                @endif

                            </td>

                            <td>

                                <strong>{{ $user->name }}</strong>

                            </td>

                            <td>

                                {{ $user->email }}

                            </td>

                           

                            <td>

                                {{ $user->employee_id ?? '-' }}

                            </td>

                       <td style="min-width:220px;">

@if($user->gates->count())

<button
    class="btn btn-sm btn-outline-primary"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#gate{{ $user->id }}"
    aria-expanded="false">

    <i class="bi bi-door-open"></i>

    {{ $user->gates->count() }}

    Gate(s)

    <i class="bi bi-chevron-down ms-1"></i>

</button>

<div class="collapse mt-2" id="gate{{ $user->id }}">

    @foreach($user->gates as $gate)

        <div class="border rounded p-2 mb-2 bg-light">

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

    @endforeach

</div>

@else

<span class="badge bg-secondary">

    No Gate Assigned

</span>

@endif

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

                           <td class="text-nowrap">

                             <a href="{{ route('users.show',$user->id) }}"
       class="btn btn-light btn-sm border"
       title="View User">

        <i class="bi bi-eye-fill text-info"></i>

    </a>

    <a href="{{ route('users.edit',$user->id) }}"
       class="btn btn-light btn-sm border"
       title="Edit User">

        <i class="bi bi-pencil-square text-primary"></i>

    </a>

    <form action="{{ route('users.destroy',$user->id) }}"
          method="POST"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-light btn-sm border"
                title="Delete User"
                onclick="return confirm('Delete this user?')">

            <i class="bi bi-trash text-danger"></i>

        </button>

    </form>

</td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="8" class="text-center py-4">

                                No Users Found

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
