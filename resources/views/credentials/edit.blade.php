@extends('layouts.app')

@section('content')

<div class="card-box">

    <h3 class="mb-4">

        Edit Credential

    </h3>

    <form action="{{ route('credentials.update',$credential->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">

                <label>User</label>

                <select name="user_id"
                        class="form-control">

                    @foreach($users as $user)

                        <option
                        value="{{ $user->id }}"
                        {{ $credential->user_id == $user->id ? 'selected' : '' }}>

                        {{ $user->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-6 mb-3">

                <label>Credential Type</label>

                <select name="credential_type"
                        class="form-control">

                    <option value="card"
                    {{ $credential->credential_type == 'card' ? 'selected':'' }}>

                    RFID Card

                    </option>

                    <option value="pin"
                    {{ $credential->credential_type == 'pin' ? 'selected':'' }}>

                    PIN

                    </option>

                    <option value="fingerprint"
                    {{ $credential->credential_type == 'fingerprint' ? 'selected':'' }}>

                    Fingerprint

                    </option>

                    <option value="palm"
                    {{ $credential->credential_type == 'palm' ? 'selected':'' }}>

                    Palm

                    </option>

                    <option value="face"
                    {{ $credential->credential_type == 'face' ? 'selected':'' }}>

                    Face

                    </option>

                </select>

            </div>

            <div class="col-md-6 mb-3">

                <label>Credential Value</label>

                <input type="text"
                       name="credential_value"
                       class="form-control"
                       value="{{ $credential->credential_value }}">

            </div>

            <div class="col-md-6 mb-3">

                <label>Status</label>

                <select name="status"
                        class="form-control">

                    <option value="1"
                    {{ $credential->status ? 'selected':'' }}>

                    Active

                    </option>

                    <option value="0"
                    {{ !$credential->status ? 'selected':'' }}>

                    Inactive

                    </option>

                </select>

            </div>

            <div class="col-md-12 mb-3">

                <label>Notes</label>

                <textarea name="notes"
                          class="form-control"
                          rows="3">{{ $credential->notes }}</textarea>

            </div>

        </div>

        <button class="btn btn-success">

            Update Credential

        </button>

    </form>

</div>

@endsection