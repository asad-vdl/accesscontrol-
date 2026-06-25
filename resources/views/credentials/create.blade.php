@extends('layouts.app')

@section('content')

<div class="card-box">

    <h3 class="mb-4">

        Add Credential

    </h3>

    <form action="{{ route('credentials.store') }}"
          method="POST">

        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">

                <label>User</label>

                <select name="user_id"
                        class="form-control">

                    @foreach($users as $user)

                        <option value="{{ $user->id }}">

                            {{ $user->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-6 mb-3">

                <label>Credential Type</label>

                <select name="credential_type"
                        class="form-control">

                    <option value="card">
                        RFID Card
                    </option>

                    <option value="pin">
                        PIN Code
                    </option>

                    <option value="fingerprint">
                        Fingerprint
                    </option>

                    <option value="palm">
                        Palm
                    </option>

                    <option value="face">
                        Face Recognition
                    </option>

                </select>

            </div>

            <div class="col-md-6 mb-3">

                <label>Credential Value</label>

                <input type="text"
                       name="credential_value"
                       class="form-control">

            </div>

            <div class="col-md-6 mb-3">

                <label>Status</label>

                <select name="status"
                        class="form-control">

                    <option value="1">
                        Active
                    </option>

                    <option value="0">
                        Inactive
                    </option>

                </select>

            </div>

            <div class="col-md-12 mb-3">

                <label>Notes</label>

                <textarea name="notes"
                          class="form-control"
                          rows="3"></textarea>

            </div>

        </div>

        <button type="submit"
                class="btn btn-primary">

            Save Credential

        </button>

    </form>

</div>

@endsection