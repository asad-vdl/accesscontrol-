@extends('layouts.app')


@section('content')


<div class="card-box">


<h3 class="mb-4">

Add Device

</h3>



<form action="{{route('devices.store')}}" method="POST">


@csrf



<div class="row">



<div class="col-md-6 mb-3">

<label>
Select Gate
</label>


<select name="gate_id" class="form-control @error('gate_id') is-invalid @enderror">

    <option value="">
        -- Select Gate --
    </option>

    @foreach($gates as $gate)

    <option value="{{ $gate->id }}"
        {{ old('gate_id') == $gate->id ? 'selected' : '' }}>

        {{ $gate->name }}
        @if($gate->location)
            - {{ $gate->location }}
        @endif

    </option>

    @endforeach

</select>

@error('gate_id')
<div class="text-danger mt-1">
    {{ $message }}
</div>
@enderror

</div>






<div class="col-md-6 mb-3">


<label>
Device Name
</label>


<input type="text"
name="name"
class="form-control @error('name') is-invalid @enderror"
value="{{ old('name') }}">

@error('name')
<div class="text-danger mt-1">
    {{ $message }}
</div>
@enderror


</div>







<div class="col-md-6 mb-3">


<label>
Device Type
</label>


<select name="type" class="form-control @error('type') is-invalid @enderror">

    <option value="RFID Reader" {{ old('type')=='RFID Reader'?'selected':'' }}>
        RFID Reader
    </option>

    <option value="PIN Reader" {{ old('type')=='PIN Reader'?'selected':'' }}>
        PIN Reader
    </option>

    <option value="Fingerprint Reader" {{ old('type')=='Fingerprint Reader'?'selected':'' }}>
        Fingerprint Reader
    </option>

    <option value="Palm Reader" {{ old('type')=='Palm Reader'?'selected':'' }}>
        Palm Reader
    </option>

    <option value="Face Recognition" {{ old('type')=='Face Recognition'?'selected':'' }}>
        Face Recognition
    </option>

    <option value="QR Reader" {{ old('type')=='QR Reader'?'selected':'' }}>
        QR Reader
    </option>

</select>

@error('type')
<div class="text-danger mt-1">
    {{ $message }}
</div>
@enderror


</div>







<div class="col-md-6 mb-3">


<label>
Device Code
</label>


<input type="text"
name="device_code"
class="form-control @error('device_code') is-invalid @enderror"
value="{{ old('device_code') }}">

@error('device_code')
<div class="text-danger mt-1">
    {{ $message }}
</div>
@enderror


</div>







<div class="col-md-6 mb-3">


<label>
IP Address
</label>


<input type="text"
name="ip_address"
class="form-control @error('ip_address') is-invalid @enderror"
value="{{ old('ip_address') }}">

@error('ip_address')
<div class="text-danger mt-1">
    {{ $message }}
</div>
@enderror


</div>







<div class="col-md-6 mb-3">


<label>
Location
</label>


<input type="text"
name="location"
class="form-control @error('location') is-invalid @enderror"
value="{{ old('location') }}">

@error('location')
<div class="text-danger mt-1">
    {{ $message }}
</div>
@enderror


</div>



</div>

<div class="col-md-6 mb-3">

    <label class="form-label">
        Status
    </label>

    <select
        name="status"
        class="form-control @error('status') is-invalid @enderror">

        <option value="1" {{ old('status',1)==1 ? 'selected' : '' }}>
            Active
        </option>

        <option value="0" {{ old('status')==='0' ? 'selected' : '' }}>
            Inactive
        </option>

    </select>

    @error('status')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
    @enderror

</div>


<button class="btn btn-primary">

Save Device

</button>



</form>



</div>


@endsection