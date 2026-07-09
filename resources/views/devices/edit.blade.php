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





@if($errors->any())


<div class="alert alert-danger">

<ul>

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>


</div>


@endif






<form action="{{ route('devices.update',$device->id) }}" method="POST">


@csrf

@method('PUT')



<div class="row">






<div class="col-md-6 mb-3">


<label>

Select Gate

</label>



<select name="gate_id" class="form-control" required>



@foreach($gates as $gate)


<option value="{{ $gate->id }}"


{{ $device->gate_id == $gate->id ? 'selected':'' }}>


{{ $gate->name }}

-

{{ $gate->location }}



</option>


@endforeach



</select>


</div>







<div class="col-md-6 mb-3">


<label>

Device Name

</label>



<input type="text"

name="name"

class="form-control"

value="{{ $device->name }}"

required>



</div>








<div class="col-md-6 mb-3">


<label>

Device Type

</label>




<select name="type" class="form-control">



<option value="RFID Reader"
{{ $device->type=='RFID Reader'?'selected':'' }}>

RFID Reader

</option>

 <option value="PIN Reader" {{ $device->type=='PIN Reader' ? 'selected' : '' }}>
        PIN Reader
    </option>


<option value="Fingerprint"
{{ $device->type=='Fingerprint'?'selected':'' }}>

Fingerprint

</option>



<option value="Palm"
{{ $device->type=='Palm'?'selected':'' }}>

Palm

</option>



<option value="Face Recognition"
{{ $device->type=='Face Recognition'?'selected':'' }}>

Face Recognition

</option>



<option value="Keypad"
{{ $device->type=='Keypad'?'selected':'' }}>

Keypad

</option>



</select>


</div>







<div class="col-md-6 mb-3">


<label>

Device Code

</label>



<input type="text"

name="device_code"

class="form-control"

value="{{ $device->device_code }}">



</div>







<div class="col-md-6 mb-3">


<label>

IP Address

</label>



<input type="text"

name="ip_address"

class="form-control"

value="{{ $device->ip_address }}">



</div>







<div class="col-md-6 mb-3">


<label>

Location

</label>



<input type="text"

name="location"

class="form-control"

value="{{ $device->location }}">



</div>








<div class="col-md-6 mb-3">


<label>

Status

</label>



<select name="status" class="form-control">



<option value="1"

{{ $device->status==1?'selected':'' }}>

Active

</option>



<option value="0"

{{ $device->status==0?'selected':'' }}>

Inactive

</option>



</select>



</div>





</div>





<button class="btn btn-success">

Update Device

</button>




</form>



</div>


@endsection