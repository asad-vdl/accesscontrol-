@extends('layouts.app')

@section('content')
@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    <i class="bi bi-check-circle me-2"></i>

    {{ session('success') }}

    <button type="button" 
            class="btn-close" 
            data-bs-dismiss="alert">
    </button>

</div>

@endif
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">

                <i class="bi bi-gear-fill text-primary me-2"></i>

                System Settings

            </h3>

            <p class="text-muted mb-0">

                Configure global system settings.

            </p>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                General Settings

            </h5>

        </div>

        <div class="card-body">

            <form action="{{ route('settings.update') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Company Name

                        </label>

                        <input type="text"
                               name="company_name"
                               class="form-control"
                               value="{{ $setting->company_name }}">

                    </div>

                    <div class="col-md-6 mb-3">

    <label class="form-label">

        Company Logo

    </label>

    @if($setting->company_logo)

        <div class="mb-3">

            <img src="{{ asset('storage/'.$setting->company_logo) }}"
     class="border rounded-3 p-2 bg-light"
     style="max-height:120px;">
        </div>

    @endif

    <input type="file"
           name="company_logo"
           class="form-control">

</div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Timezone

                        </label>

                        <select name="timezone"
                                class="form-select">

                            <option value="Asia/Riyadh"
                                {{ $setting->timezone=='Asia/Riyadh' ? 'selected' : '' }}>

                                Asia/Riyadh

                            </option>

                            <option value="Asia/Karachi"
                                {{ $setting->timezone=='Asia/Karachi' ? 'selected' : '' }}>

                                Asia/Karachi

                            </option>

                            <option value="UTC"
                                {{ $setting->timezone=='UTC' ? 'selected' : '' }}>

                                UTC

                            </option>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Door Unlock Time (Seconds)

                        </label>

                        <input type="number"
                               name="door_unlock_time"
                               min="1"
                               max="30"
                               class="form-control"
                               value="{{ $setting->door_unlock_time }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <div class="form-check form-switch mt-4">

                            <input class="form-check-input"
                                   type="checkbox"
                                   name="voice_enabled"
                                   value="1"
                                   {{ $setting->voice_enabled ? 'checked' : '' }}>

                            <label class="form-check-label">

                                Enable Voice

                            </label>

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <div class="form-check form-switch mt-4">

                            <input class="form-check-input"
                                   type="checkbox"
                                   name="hardware_enabled"
                                   value="1"
                                   {{ $setting->hardware_enabled ? 'checked' : '' }}>

                            <label class="form-check-label">

                                Enable Hardware

                            </label>

                        </div>

                    </div>

                </div>

                <hr>

                <button class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">

                    <i class="bi bi-check-circle me-2"></i>

                    Save Settings

                </button>

            </form>

        </div>

    </div>

</div>

@endsection