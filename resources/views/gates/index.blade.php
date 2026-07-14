@extends('layouts.app')


@section('content')


<div class="container">

<h2 class="mb-4">
Gates
</h2>


<a href="{{ route('gates.create') }}"
   class="btn btn-primary mb-3">

    <i class="bi bi-plus-circle me-1"></i>

    Add Gate

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



<td>

    <a href="{{ route('gates.edit',$gate->id) }}"
       class="btn btn-light btn-sm border me-1"
       title="Edit Gate">

        <i class="bi bi-pencil-square text-primary"></i>

    </a>

    <form action="{{ route('gates.destroy',$gate->id) }}"
          method="POST"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="btn btn-light btn-sm border"
            title="Delete Gate"
            onclick="return confirm('Delete this gate?')">

            <i class="bi bi-trash text-danger"></i>

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