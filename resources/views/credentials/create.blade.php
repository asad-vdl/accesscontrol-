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

               <select
    name="user_id"
    class="form-control @error('user_id') is-invalid @enderror">

    <option value="">
        Select User
    </option>

    @foreach($users as $user)

        <option
            value="{{ $user->id }}"
            {{ old('user_id') == $user->id ? 'selected' : '' }}>

            {{ $user->name }}

        </option>

    @endforeach

</select>

@error('user_id')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

            </div>

            <div class="col-md-6 mb-3">

                <label>Credential Type</label>

               <select
    name="credential_type"
    class="form-control @error('credential_type') is-invalid @enderror">

    <option value="">
        Select Credential Type
    </option>

    <option value="card"
        {{ old('credential_type')=='card' ? 'selected' : '' }}>
        RFID Card
    </option>

    <option value="pin"
        {{ old('credential_type')=='pin' ? 'selected' : '' }}>
        PIN Code
    </option>

    <option value="fingerprint"
        {{ old('credential_type')=='fingerprint' ? 'selected' : '' }}>
        Fingerprint
    </option>

    <option value="palm"
        {{ old('credential_type')=='palm' ? 'selected' : '' }}>
        Palm
    </option>

    <option value="face"
        {{ old('credential_type')=='face' ? 'selected' : '' }}>
        Face Recognition
    </option>

    <option value="qr"
        {{ old('credential_type')=='qr' ? 'selected' : '' }}>
        QR Code
    </option>

</select>

@error('credential_type')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

            </div>

            <div class="col-md-6 mb-3">

                <label>Credential Value</label>

               <input
    type="text"
    name="credential_value"
    class="form-control @error('credential_value') is-invalid @enderror"
    value="{{ old('credential_value') }}">

@error('credential_value')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

            </div>

            <div class="col-md-6 mb-3">

                <label>Status</label>

                <select
    name="status"
    class="form-control @error('status') is-invalid @enderror">

    <option value="1"
        {{ old('status','1')=='1' ? 'selected' : '' }}>
        Active
    </option>

    <option value="0"
        {{ old('status')=='0' ? 'selected' : '' }}>
        Inactive
    </option>

</select>

@error('status')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
            </div>

            <div class="col-md-12 mb-3">

                <label>Notes</label>

                <textarea
    name="notes"
    rows="3"
    class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>

@error('notes')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

            </div>

        </div>

        <button type="submit"
                class="btn btn-primary">

            Save Credential

        </button>

    </form>

</div>

@endsection