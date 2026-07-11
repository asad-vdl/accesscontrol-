```blade
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card">

                <div class="card-header">

                    <h4 class="mb-0">

                        <i class="bi bi-key-fill"></i>

                        Change Password

                    </h4>

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('profile.password.update') }}"
                        method="POST">

                        @csrf

                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">

                                Current Password

                            </label>

                            <input
                                type="password"
                                name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror">

                            @error('current_password')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                New Password

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror">

                            @error('password')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Confirm New Password

                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control">

                        </div>

                        <div class="d-flex justify-content-between">

                            <a
                                href="{{ route('profile.edit') }}"
                                class="btn btn-secondary">

                                <i class="bi bi-arrow-left"></i>

                                Back

                            </a>

                            <button
                                type="submit"
                                class="btn btn-success">

                                <i class="bi bi-shield-lock-fill"></i>

                                Update Password

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
```
