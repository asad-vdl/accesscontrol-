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
Device Name
</label>


<input type="text"
name="name"
class="form-control">


</div>





<div class="col-md-6 mb-3">


<label>
Device Type
</label>


<select name="type" class="form-control">


<option>RFID Reader</option>

<option>Fingerprint</option>

<option>Palm</option>

<option>Face Recognition</option>

<option>Keypad</option>


</select>


</div>






<div class="col-md-6 mb-3">


<label>
Device Code
</label>


<input type="text"
name="device_code"
class="form-control">


</div>





<div class="col-md-6 mb-3">


<label>
IP Address
</label>


<input type="text"
name="ip_address"
class="form-control">


</div>





<div class="col-md-6 mb-3">


<label>
Location
</label>


<input type="text"
name="location"
class="form-control">


</div>



</div>



<button class="btn btn-primary">

Save Device

</button>



</form>



</div>


@endsection