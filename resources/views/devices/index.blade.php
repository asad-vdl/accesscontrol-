@extends('layouts.app')

@section('content')


<div class="container-fluid">


    <a href="{{ route('devices.create') }}"
   class="btn btn-primary mb-4">

    <i class="bi bi-plus-circle me-1"></i>

    Add Device

</a>



</div>



@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif





<div class="row mb-4">


<div class="col-md-3 mb-3">

<div class="card border-0 shadow-sm">

<div class="card-body">

<h6 class="text-muted">
Total Devices
</h6>


<h2 class="text-primary fw-bold">

{{ $totalDevices }}

</h2>


</div>

</div>

</div>





<div class="col-md-3 mb-3">

<div class="card border-0 shadow-sm">

<div class="card-body">

<h6 class="text-muted">
Active Devices
</h6>


<h2 class="text-success fw-bold">

{{ $activeDevices }}

</h2>


</div>

</div>

</div>







<div class="col-md-3 mb-3">

<div class="card border-0 shadow-sm">

<div class="card-body">

<h6 class="text-muted">
Online Devices
</h6>


<h2 class="text-info fw-bold">

{{ $onlineDevices }}

</h2>


</div>

</div>

</div>







<div class="col-md-3 mb-3">

<div class="card border-0 shadow-sm">

<div class="card-body">

<h6 class="text-muted">
Offline Devices
</h6>


<h2 class="text-danger fw-bold">

{{ $offlineDevices }}

</h2>


</div>

</div>

</div>



</div>








<div class="card border-0 shadow-sm">


<div class="card-header bg-white">

<h5 class="mb-0">

Device Inventory

</h5>


</div>





<div class="card-body">


<div class="table-responsive">



<table class="table table-hover align-middle">



<thead class="table-light">


<tr>

<th>ID</th>

<th>Gate</th>

<th>Device Name</th>

<th>Type</th>

<th>Code</th>

<th>IP Address</th>

<th>Location</th>

<th>Enabled</th>

<th>Connection</th>

<th>Actions</th>


</tr>


</thead>






<tbody>


@forelse($devices as $device)



<tr>



<td>

{{ $device->id }}

</td>





<td>


@if($device->gate)


<span class="badge bg-primary">

{{ $device->gate->name }}

</span>


@else

<span class="badge bg-secondary">

No Gate

</span>


@endif



</td>







<td>

<strong>

{{ $device->name }}

</strong>

</td>







<td>

{{ $device->type }}

</td>







<td>

{{ $device->device_code }}

</td>







<td>

{{ $device->ip_address ?? '-' }}

</td>







<td>

{{ $device->location ?? '-' }}

</td>







<td>

@if($device->status)

<span class="d-inline-flex align-items-center">

    <span class="rounded-circle bg-success me-2"
          style="width:10px;height:10px;"></span>

    Enabled

</span>

@else

<span class="d-inline-flex align-items-center">

    <span class="rounded-circle bg-danger me-2"
          style="width:10px;height:10px;"></span>

    Disabled

</span>

@endif

</td>






<td>

@if($device->online_status)

<span class="d-inline-flex align-items-center">

    <span class="rounded-circle bg-success me-2"
          style="width:10px;height:10px;"></span>

    Online

</span>

@else

<span class="d-inline-flex align-items-center">

    <span class="rounded-circle bg-danger me-2"
          style="width:10px;height:10px;"></span>

    Offline

</span>

@endif

</td>





<td>

    <div class="d-flex align-items-center gap-2">

        <a href="{{ route('devices.show', $device->id) }}"
   class="btn btn-light btn-sm border"
   title="View Device">

    <i class="bi bi-eye text-success"></i>

</a>

        <a href="{{ route('devices.edit',$device->id) }}"
           class="btn btn-light btn-sm border"
           title="Edit Device">

            <i class="bi bi-pencil-square text-primary"></i>

        </a>

        <form action="{{ route('devices.destroy',$device->id) }}"
              method="POST"
              class="m-0">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-light btn-sm border"
                    title="Delete Device"
                    onclick="return confirm('Delete this device?')">

                <i class="bi bi-trash text-danger"></i>

            </button>

        </form>

    </div>

</td>




</tr>





@empty



<tr>


<td colspan="10" class="text-center py-4">


No Devices Found


</td>


</tr>



@endforelse




</tbody>



</table>



</div>



</div>


</div>


@endsection