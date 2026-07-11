@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">

                        <i class="bi bi-person-circle"></i>

                        My Profile

                    </h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('profile.update') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        @method('PUT')

                        <div class="row">

                            <div class="col-md-4 text-center">

                                @if($user->photo)

                                    <img src="{{ asset('storage/'.$user->photo) }}"
                                         class="rounded-circle shadow border mb-3"
                                         width="200"
                                         height="200"
                                         style="object-fit:cover;">

                                @else

                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D6EFD&color=fff&size=200"
                                         class="rounded-circle shadow border mb-3">

                                @endif

                                <input type="file"
                                       name="photo"
                                       class="form-control @error('photo') is-invalid @enderror">

                                @error('photo')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="col-md-8">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Full Name

                                        </label>

                                        <input type="text"
                                               name="name"
                                               value="{{ old('name',$user->name) }}"
                                               class="form-control @error('name') is-invalid @enderror">

                                        @error('name')

                                            <div class="invalid-feedback">

                                                {{ $message }}

                                            </div>

                                        @enderror

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Email

                                        </label>

                                        <input type="email"
                                               name="email"
                                               value="{{ old('email',$user->email) }}"
                                               class="form-control @error('email') is-invalid @enderror">

                                        @error('email')

                                            <div class="invalid-feedback">

                                                {{ $message }}

                                            </div>

                                        @enderror

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Phone

                                        </label>

                                        <input type="text"
                                               name="phone"
                                               value="{{ old('phone',$user->phone) }}"
                                               class="form-control">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Employee ID

                                        </label>

                                        <input type="text"
                                               value="{{ $user->employee_id }}"
                                               class="form-control"
                                               readonly>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Role

                                        </label>

                                        <input type="text"
                                               value="{{ ucfirst($user->role) }}"
                                               class="form-control"
                                               readonly>

                                    </div>

                                </div>

                                <hr>

                                <h5>

                                    Change Password

                                </h5>

                                <div class="row">

                                    <div class="col-md-4 mb-3">

                                        <label class="form-label">

                                            Current Password

                                        </label>

                                        <input type="password"
                                               name="current_password"
                                               class="form-control @error('current_password') is-invalid @enderror">

                                        @error('current_password')

                                            <div class="invalid-feedback">

                                                {{ $message }}

                                            </div>

                                        @enderror

                                    </div>

                                    <div class="col-md-4 mb-3">

                                        <label class="form-label">

                                            New Password

                                        </label>

                                        <input type="password"
                                               name="password"
                                               class="form-control @error('password') is-invalid @enderror">

                                        @error('password')

                                            <div class="invalid-feedback">

                                                {{ $message }}

                                            </div>

                                        @enderror

                                    </div>

                                    <div class="col-md-4 mb-3">

                                        <label class="form-label">

                                            Confirm Password

                                        </label>

                                        <input type="password"
                                               name="password_confirmation"
                                               class="form-control">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <hr>

                        <div class="text-end">

                            <a href="{{ route('dashboard') }}"
                               class="btn btn-secondary">

                                <i class="bi bi-arrow-left"></i>

                                Back

                            </a>

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-check-circle-fill"></i>

                                Save Changes

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection