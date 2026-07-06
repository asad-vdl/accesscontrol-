```blade
@extends('layouts.app')

@section('content')

<div class="card-box">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>Edit User</h3>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('users.update',$user->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="row">


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Name
                </label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ $user->name }}">

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ $user->email }}">

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Phone
                </label>

                <input type="text"
                       name="phone"
                       class="form-control"
                       value="{{ $user->phone }}">

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Employee ID
                </label>

                <input type="text"
                       name="employee_id"
                       class="form-control"
                       value="{{ $user->employee_id }}">

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Role
                </label>

                <select name="role" class="form-control">

                    <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="operator" {{ $user->role=='operator' ? 'selected' : '' }}>
                        Operator
                    </option>

                    <option value="security" {{ $user->role=='security' ? 'selected' : '' }}>
                        Security Guard
                    </option>

                </select>

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Status
                </label>

                <select name="status" class="form-control">

                    <option value="1" {{ $user->status ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0" {{ !$user->status ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Profile Photo
                </label>

                <input type="file"
                       name="photo"
                       class="form-control"
                       accept=".jpg,.jpeg,.png">

                <small class="text-muted">
                    Leave empty if you don't want to change the photo.
                </small>

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Current Photo
                </label>

                <br>

                @if($user->photo)

                    <img src="{{ asset('storage/'.$user->photo) }}"
                         width="120"
                         class="img-thumbnail">

                @else

                    <span class="text-muted">
                        No Photo
                    </span>

                @endif

            </div>


        </div>

        <button type="submit"
                class="btn btn-success">

            Update User

        </button>

    </form>

</div>

@endsection

