@extends('layouts.app')


@section('content')


<div class="card-box">


<div class="d-flex justify-content-between align-items-center mb-4">


<h3>
Edit Device
</h3>


<a href="{{ route('devices.index') }}" 
class="btn btn-secondary">

Back

</a>


</div>





<form action="{{ route('devices.update',$device->id) }}" method="POST">


@csrf

@method('PUT')



<div class="row">






<div class="col-md-6 mb-3">


<label>

Select Gate

</label>



<select name="gate_id" class="form-control @error('gate_id') is-invalid @enderror">

    @foreach($gates as $gate)

    <option value="{{ $gate->id }}"
        {{ old('gate_id', $device->gate_id) == $gate->id ? 'selected' : '' }}>

        {{ $gate->name }}

        @if($gate->location)
            - {{ $gate->location }}
        @endif

    </option>

    @endforeach

</select>

@error('gate_id')
<div class="text-danger mt-1">{{ $message }}</div>
@enderror


</div>







<div class="col-md-6 mb-3">


<label>

Device Name

</label>



<input type="text"
name="name"
class="form-control @error('name') is-invalid @enderror"
value="{{ old('name', $device->name) }}">

@error('name')
<div class="text-danger mt-1">{{ $message }}</div>
@enderror



</div>








<div class="col-md-6 mb-3">


<label>

Device Type

</label>




<select name="type" class="form-control @error('type') is-invalid @enderror">

<option value="RFID Reader"
{{ old('type',$device->type)=='RFID Reader'?'selected':'' }}>
RFID Reader
</option>

<option value="PIN Reader"
{{ old('type',$device->type)=='PIN Reader'?'selected':'' }}>
PIN Reader
</option>

<option value="Fingerprint Reader"
{{ old('type',$device->type)=='Fingerprint Reader'?'selected':'' }}>
Fingerprint Reader
</option>

<option value="Palm Reader"
{{ old('type',$device->type)=='Palm Reader'?'selected':'' }}>
Palm Reader
</option>

<option value="Face Recognition"
{{ old('type',$device->type)=='Face Recognition'?'selected':'' }}>
Face Recognition
</option>

<option value="QR Reader"
{{ old('type',$device->type)=='QR Reader'?'selected':'' }}>
QR Reader
</option>

</select>

@error('type')
<div class="text-danger mt-1">{{ $message }}</div>
@enderror


</div>







<div class="col-md-6 mb-3">


<label>

Device Code

</label>



<input type="text"
name="device_code"
class="form-control @error('device_code') is-invalid @enderror"
value="{{ old('device_code', $device->device_code) }}">

@error('device_code')
<div class="text-danger mt-1">{{ $message }}</div>
@enderror

</div>







<div class="col-md-6 mb-3">


<label>

IP Address

</label>



<input type="text"
name="ip_address"
class="form-control @error('ip_address') is-invalid @enderror"
value="{{ old('ip_address', $device->ip_address) }}">

@error('ip_address')
<div class="text-danger mt-1">{{ $message }}</div>
@enderror



</div>







<div class="col-md-6 mb-3">


<label>

Location

</label>


<input type="text"
name="location"
class="form-control @error('location') is-invalid @enderror"
value="{{ old('location', $device->location) }}">

@error('location')
<div class="text-danger mt-1">{{ $message }}</div>
@enderror



</div>








<div class="col-md-6 mb-3">


<label>

Status

</label>



<select name="status" class="form-control @error('status') is-invalid @enderror">

<option value="1"
{{ old('status',$device->status)==1 ? 'selected' : '' }}>
Active
</option>

<option value="0"
{{ old('status',$device->status)==0 ? 'selected' : '' }}>
Inactive
</option>

</select>

@error('status')
<div class="text-danger mt-1">{{ $message }}</div>
@enderror



</div>





</div>





<button class="btn btn-success">

Update Device

</button>




</form>



</div>


@endsection