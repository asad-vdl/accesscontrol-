
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <a href="{{ route('users.create') }}" class="btn btn-primary">
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

                            <th>Phone</th>

                            <th>Employee ID</th>

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

                                {{ $user->phone ?? '-' }}

                            </td>

                            <td>

                                {{ $user->employee_id ?? '-' }}

                            </td>

                            <td>

                                @if($user->status)

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

                                <a href="{{ route('users.edit',$user->id) }}"
                                   class="btn btn-sm btn-warning">

                                    Edit

                                </a>

                                <form action="{{ route('users.destroy',$user->id) }}"
                                      method="POST"
                                      style="display:inline-block;">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this user?')">

                                        Delete

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
