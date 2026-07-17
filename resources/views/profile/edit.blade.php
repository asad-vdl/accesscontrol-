@extends('layouts.app')

@section('content')

<div class="container pt-0 pb-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row justify-content-end">
        <div class="col-xl-4 col-lg-5 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 ms-auto"
                 style="max-width:340px;">

                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0">
                        <i class="bi bi-person-circle me-2"></i>
                        My Profile
                    </h4>
                </div>

                <div class="card-body p-3">

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="text-center mb-3">

    @if($user->photo)

        <img src="{{ asset('storage/'.$user->photo) }}"
             class="rounded-circle shadow border"
             width="100"
             height="100"
             style="object-fit:cover; border:3px solid #fff;">

    @else

        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D6EFD&color=fff&size=100"
             class="rounded-circle shadow border"
             width="100"
             height="100"
             style="border:3px solid #fff;">

    @endif

</div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name"
                                   value="{{ old('name',$user->name) }}"
                                   class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email"
                                   value="{{ old('email',$user->email) }}"
                                   class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">

    <label class="form-label fw-semibold">

        Current Password

    </label>

    <input
        type="password"
        name="current_password"
        class="form-control @error('current_password') is-invalid @enderror"
        placeholder="Enter current password">

    @error('current_password')

        <div class="invalid-feedback">

            {{ $message }}

        </div>

    @enderror

</div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">New Password</label>
                            <input type="password" name="password"
                                   placeholder="Leave blank if you don't want to change it"
                                   class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Profile Photo</label>
                            <input type="file"
                                   name="photo"
                                   class="form-control @error('photo') is-invalid @enderror">

                            <small class="text-muted">
                                JPG, JPEG or PNG (Maximum 2MB)
                            </small>

                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                Update Profile
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection
