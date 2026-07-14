
@extends('layouts.app')

@section('content')

<div class="card-box">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>
            Add New User
        </h3>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>



    <form action="{{ route('users.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf


        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Name
                </label>

                <input
    type="text"
    name="name"
    class="form-control @error('name') is-invalid @enderror"
    placeholder="Enter Name"
    value="{{ old('name') }}">

@error('name')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email
                </label>

                <input
    type="email"
    name="email"
    class="form-control @error('email') is-invalid @enderror"
    placeholder="Enter Email"
    value="{{ old('email') }}">

@error('email')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Phone
                </label>

                <input
    type="text"
    name="phone"
    class="form-control @error('phone') is-invalid @enderror"
    placeholder="Enter Phone"
    value="{{ old('phone') }}">

@error('phone')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Employee ID
                </label>

                <input
    type="text"
    name="employee_id"
    class="form-control @error('employee_id') is-invalid @enderror"
    placeholder="Enter Employee ID"
    value="{{ old('employee_id') }}">

@error('employee_id')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Password
                </label>

               <input
    type="password"
    name="password"
    class="form-control @error('password') is-invalid @enderror"
    placeholder="Enter Password">

@error('password')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Role
                </label>

                <select
    name="role"
    class="form-control @error('role') is-invalid @enderror">

    <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
    <option value="operator" {{ old('role')=='operator'?'selected':'' }}>Operator</option>
    <option value="security" {{ old('role')=='security'?'selected':'' }}>Security Guard</option>

</select>

@error('role')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Status
                </label>

                <select
    name="status"
    class="form-control @error('status') is-invalid @enderror">

    <option value="1" {{ old('status',1)=='1'?'selected':'' }}>Active</option>
    <option value="0" {{ old('status')=='0'?'selected':'' }}>Inactive</option>

</select>

@error('status')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Profile Photo
                </label>

               <input
    type="file"
    name="photo"
    class="form-control @error('photo') is-invalid @enderror"
    accept=".jpg,.jpeg,.png">

@error('photo')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

                <small class="text-muted">
                    JPG, JPEG, PNG (Maximum 2MB)
                </small>

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

                    id="gate{{ $gate->id }}">



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

    @error('gate_ids')
<div class="text-danger mt-2">
    {{ $message }}
</div>
@enderror


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
        ] as $day=>$label)

            <div class="form-check form-check-inline">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="{{ $day }}"
                    value="1"
                    {{ $defaultSchedule[$day] ? 'checked' : '' }}>

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
    class="form-control @error('start_time') is-invalid @enderror"
    value="{{ old('start_time',$defaultSchedule['start_time']) }}">

@error('start_time')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">

            End Time

        </label>

       <input
    type="time"
    name="end_time"
    class="form-control @error('end_time') is-invalid @enderror"
    value="{{ old('end_time',$defaultSchedule['end_time']) }}">

@error('end_time')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">

            Valid From

        </label>

        <input
    type="date"
    name="valid_from"
    class="form-control @error('valid_from') is-invalid @enderror"
    value="{{ old('valid_from') }}">

@error('valid_from')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">

            Valid To

        </label>

        <input
    type="date"
    name="valid_to"
    class="form-control @error('valid_to') is-invalid @enderror"
    value="{{ old('valid_to') }}">

@error('valid_to')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">

            Schedule Status

        </label>

        <select
    name="schedule_status"
    class="form-select @error('schedule_status') is-invalid @enderror">

    <option value="1" {{ old('schedule_status',1)=='1'?'selected':'' }}>
        Active
    </option>

    <option value="0" {{ old('schedule_status')=='0'?'selected':'' }}>
        Inactive
    </option>

</select>

@error('schedule_status')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

    </div>

</div>

        <button type="submit" class="btn btn-primary">

            Save User

        </button>

    </form>

</div>

@endsection

