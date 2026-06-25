@extends('layouts.app')


@section('content')


<div class="card-box">


    <div class="d-flex justify-content-between align-items-center mb-4">


        <h3>
            Edit User
        </h3>


        <a href="{{ route('users.index') }}" class="btn btn-secondary">

            Back

        </a>


    </div>





    @if($errors->any())

    <div class="alert alert-danger">

        <ul>

            @foreach($errors->all() as $error)

            <li>
                {{ $error }}
            </li>

            @endforeach

        </ul>

    </div>

    @endif





    <form action="{{ route('users.update',$user->id) }}" method="POST">


        @csrf

        @method('PUT')



        <div class="row">





            <div class="col-md-6 mb-3">


                <label class="form-label">

                    Name

                </label>


                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ $user->name }}">


            </div>






            <div class="col-md-6 mb-3">


                <label class="form-label">

                    Email

                </label>


                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ $user->email }}">


            </div>






            <div class="col-md-6 mb-3">


                <label class="form-label">

                    Phone

                </label>


                <input type="text"
                       name="phone"
                       class="form-control"
                       value="{{ $user->phone }}">


            </div>







            <div class="col-md-6 mb-3">


                <label class="form-label">

                    Employee ID

                </label>


                <input type="text"
                       name="employee_id"
                       class="form-control"
                       value="{{ $user->employee_id }}">


            </div>



            <div class="col-md-6 mb-3">

    <label class="form-label">
        Role
    </label>

    <select name="role" class="form-control">

        <option value="admin"
            {{ $user->role == 'admin' ? 'selected' : '' }}>
            Admin
        </option>

        <option value="operator"
            {{ $user->role == 'operator' ? 'selected' : '' }}>
            Operator
        </option>

        <option value="security"
            {{ $user->role == 'security' ? 'selected' : '' }}>
            Security Guard
        </option>

    </select>

</div>



            <div class="col-md-6 mb-3">


                <label class="form-label">

                    Status

                </label>



                <select name="status" class="form-control">


                    <option value="1"
                    {{ $user->status == 1 ? 'selected':'' }}>

                        Active

                    </option>



                    <option value="0"
                    {{ $user->status == 0 ? 'selected':'' }}>

                        Inactive

                    </option>


                </select>


            </div>





        </div>






        <button type="submit" class="btn btn-success">

            Update User

        </button>




    </form>




</div>



@endsection