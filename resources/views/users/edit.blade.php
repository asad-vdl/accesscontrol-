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

        <div class="col-md-12 mb-3">

<label class="form-label">

Assign Gate Permissions

</label>



<div class="row">



@foreach($gates as $gate)



<div class="col-md-4 mb-2">



<div class="form-check">



<input

class="form-check-input"

type="checkbox"

name="gate_ids[]"

value="{{ $gate->id }}"

id="gate{{ $gate->id }}"

{{ in_array($gate->id,$assignedGates) ? 'checked':'' }}>




<label

class="form-check-label"

for="gate{{ $gate->id }}">



{{ $gate->name }}



@if($gate->location)


<small class="text-muted">

({{ $gate->location }})

</small>


@endif



</label>



</div>



</div>



@endforeach



</div>


</div>

<hr>

<h5 class="mb-3">

    <i class="bi bi-calendar-week"></i>

    Access Schedule

</h5>

<div class="row">

    <div class="col-md-12 mb-3">

        @foreach([
            'monday'=>'Monday',
            'tuesday'=>'Tuesday',
            'wednesday'=>'Wednesday',
            'thursday'=>'Thursday',
            'friday'=>'Friday',
            'saturday'=>'Saturday',
            'sunday'=>'Sunday'
        ] as $day => $label)

            <div class="form-check form-check-inline">

                <input
                    type="checkbox"
                    class="form-check-input"
                    name="{{ $day }}"
                    value="1"
                    {{ $schedule->$day ? 'checked' : '' }}>

                <label class="form-check-label">

                    {{ $label }}

                </label>

            </div>

        @endforeach

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">

            Start Time

        </label>

        <input
            type="time"
            name="start_time"
            class="form-control"
            value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}">

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">

            End Time

        </label>

        <input
            type="time"
            name="end_time"
            class="form-control"
            value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}">

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">

            Valid From

        </label>

        <input
            type="date"
            name="valid_from"
            class="form-control"
            value="{{ optional($schedule->valid_from)->format('Y-m-d') }}">

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">

            Valid To

        </label>

        <input
            type="date"
            name="valid_to"
            class="form-control"
            value="{{ optional($schedule->valid_to)->format('Y-m-d') }}">

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">

            Schedule Status

        </label>

        <select
            name="schedule_status"
            class="form-select">

            <option value="1"
                {{ $schedule->status ? 'selected' : '' }}>

                Active

            </option>

            <option value="0"
                {{ !$schedule->status ? 'selected' : '' }}>

                Inactive

            </option>

        </select>

    </div>

</div>

        <button type="submit"
                class="btn btn-success">

            Update User

        </button>

    </form>

</div>

@endsection

