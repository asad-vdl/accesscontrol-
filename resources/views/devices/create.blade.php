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


<select name="gate_id" class="form-control" required>


<option value="">
-- Select Gate --
</option>



@foreach($gates as $gate)


<option value="{{ $gate->id }}">
  {{ $gate->name }}
    @if($gate->location)
        - {{ $gate->location }}
    @endif

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
required>


</div>







<div class="col-md-6 mb-3">


<label>
Device Type
</label>


<select name="type" class="form-control" required>

    <option value="RFID Reader">
        RFID Reader
    </option>

    <option value="PIN Reader">
        PIN Reader
    </option>

    <option value="Fingerprint Reader">
        Fingerprint Reader
    </option>

    <option value="Palm Reader">
        Palm Reader
    </option>

    <option value="Face Recognition">
        Face Recognition
    </option>

    <option value="QR Reader">
        QR Reader
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
required>


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