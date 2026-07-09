@extends('layouts.app')


@section('content')


<div class="container">


<h2>
Edit Gate
</h2>



<form method="POST"
action="{{ route('gates.update',$gate->id) }}">


@csrf

@method('PUT')



<div class="mb-3">

<label>
Gate Name
</label>


<input type="text"
name="name"
class="form-control"
value="{{ $gate->name }}"
required>


</div>




<div class="mb-3">

<label>
Location
</label>


<input type="text"
name="location"
class="form-control"
value="{{ $gate->location }}">


</div>




<div class="mb-3">

<label>
Description
</label>


<textarea name="description"
class="form-control">{{ $gate->description }}</textarea>


</div>




<div class="mb-3">

<label>
Status
</label>


<select name="status"
class="form-control">


<option value="1"
@if($gate->status == 1) selected @endif>
Active
</option>


<option value="0"
@if($gate->status == 0) selected @endif>
Inactive
</option>


</select>


</div>



<button class="btn btn-primary">

Update Gate

</button>



</form>



</div>


@endsection