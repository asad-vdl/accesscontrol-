@extends('layouts.app')


@section('content')


<div class="container">


<h2>
Add Gate
</h2>



<form method="POST"
action="{{ route('gates.store') }}">


@csrf



<div class="mb-3">

<label>
Gate Name
</label>

<input type="text"
name="name"
class="form-control"
required>

</div>




<div class="mb-3">

<label>
Location
</label>


<input type="text"
name="location"
class="form-control">

</div>




<div class="mb-3">

<label>
Description
</label>


<textarea name="description"
class="form-control"></textarea>


</div>




<div class="mb-3">


<label>
Status
</label>


<select name="status" class="form-control">

<option value="1">
Active
</option>

<option value="0">
Inactive
</option>

</select>


</div>




<button class="btn btn-success">

Save Gate

</button>



</form>



</div>


@endsection