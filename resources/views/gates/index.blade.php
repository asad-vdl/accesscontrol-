@extends('layouts.app')

@section('content')


<div class="container-fluid">


    <a href="{{ route('gates.create') }}"
       class="btn btn-primary mb-4">

        <i class="bi bi-plus-circle me-1"></i>

        Add Gate

    </a>



@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif




<div class="card border-0 shadow-sm">


<div class="card-header bg-white">

<h5 class="mb-0">

Gate Management

</h5>

</div>




<div class="card-body">


<div class="table-responsive">


<table class="table table-hover align-middle">


<thead class="table-light">


<tr>

<th>ID</th>

<th>Name</th>

<th>Location</th>

<th>Status</th>

<th width="150">
Actions
</th>


</tr>


</thead>




<tbody>


@forelse($gates as $gate)


<tr>


<td>

{{ $gate->id }}

</td>



<td>

<strong>

{{ $gate->name }}

</strong>

</td>




<td>

{{ $gate->location ?? '-' }}

</td>




<td>


@if($gate->status)


<span class="d-inline-flex align-items-center">

    <span class="rounded-circle bg-success me-2"
          style="width:10px;height:10px;"></span>

    Active

</span>


@else


<span class="d-inline-flex align-items-center">

    <span class="rounded-circle bg-danger me-2"
          style="width:10px;height:10px;"></span>

    Inactive

</span>


@endif


</td>





<td class="text-nowrap">


<a href="{{ route('gates.edit',$gate->id) }}"
   class="btn btn-light btn-sm border"
   title="Edit Gate">


<i class="bi bi-pencil-square text-primary"></i>


</a>




<form action="{{ route('gates.destroy',$gate->id) }}"
      method="POST"
      class="d-inline">


@csrf
@method('DELETE')


<button type="submit"
        class="btn btn-light btn-sm border"
        title="Delete Gate"
        onclick="return confirm('Delete this gate?')">


<i class="bi bi-trash text-danger"></i>


</button>


</form>


</td>


</tr>



@empty


<tr>


<td colspan="5"
    class="text-center py-4">


No Gates Found


</td>


</tr>


@endforelse



</tbody>



</table>


</div>


<div class="mt-3">

{{ $gates->links() }}

</div>


</div>


</div>


</div>


@endsection