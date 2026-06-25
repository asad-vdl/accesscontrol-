@extends('layouts.app')


@section('content')


<div class="card-box">


    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>
            Add New User
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






    <form action="{{ route('users.store') }}" method="POST">

        @csrf



        <div class="row">



            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Name
                </label>


                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Enter Name"
                       value="{{ old('name') }}">

            </div>





            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email
                </label>


                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Enter Email"
                       value="{{ old('email') }}">

            </div>





            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Phone
                </label>


                <input type="text"
                       name="phone"
                       class="form-control"
                       placeholder="Enter Phone"
                       value="{{ old('phone') }}">

            </div>





            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Employee ID
                </label>


                <input type="text"
                       name="employee_id"
                       class="form-control"
                       placeholder="Enter Employee ID"
                       value="{{ old('employee_id') }}">

            </div>






            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Password
                </label>


                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter Password">

            </div>






            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Status
                </label>


                <select name="status" class="form-control">


                    <option value="1">
                        Active
                    </option>


                    <option value="0">
                        Inactive
                    </option>


                </select>


            </div>




        </div>





        <button type="submit" class="btn btn-primary">

            Save User

        </button>



    </form>



</div>



@endsection