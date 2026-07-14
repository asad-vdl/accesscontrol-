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
       class="form-control @error('name') is-invalid @enderror"
       value="{{ old('name', $gate->name) }}">

@error('name')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror


</div>




<div class="mb-3">

<label>
Location
</label>


<input type="text"
       name="location"
       class="form-control @error('location') is-invalid @enderror"
       value="{{ old('location', $gate->location) }}">

@error('location')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror


</div>





<div class="mb-3">

<label>
Status
</label>


<select
    name="status"
    class="form-control @error('status') is-invalid @enderror">

    <option value="1"
        {{ old('status', $gate->status) == 1 ? 'selected' : '' }}>
        Active
    </option>

    <option value="0"
        {{ old('status', $gate->status) == 0 ? 'selected' : '' }}>
        Inactive
    </option>

</select>

@error('status')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

</div>



<button class="btn btn-primary">

Update Gate

</button>



</form>



</div>


@endsection