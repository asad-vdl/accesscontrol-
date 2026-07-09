@extends('layouts.app')


@section('content')


<div class="container">

<h2 class="mb-4">
Gates
</h2>


<a href="{{ route('gates.create') }}" 
class="btn btn-primary mb-3">

+ Add Gate

</a>



@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif



<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Name</th>
<th>Location</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>



<tbody>


@foreach($gates as $gate)


<tr>

<td>
{{ $gate->id }}
</td>


<td>
{{ $gate->name }}
</td>


<td>
{{ $gate->location }}
</td>



<td>

@if($gate->status == 'active')

<span class="badge bg-success">
Active
</span>

@else

<span class="badge bg-danger">
Inactive
</span>

@endif


</td>



<td>


<a href="{{ route('gates.edit',$gate->id) }}"
class="btn btn-warning btn-sm">

Edit

</a>



<form action="{{ route('gates.destroy',$gate->id) }}"
method="POST"
style="display:inline">


@csrf

@method('DELETE')


<button class="btn btn-danger btn-sm"
onclick="return confirm('Delete Gate?')">

Delete

</button>


</form>



</td>


</tr>


@endforeach


</tbody>


</table>



{{ $gates->links() }}


</div>


@endsection