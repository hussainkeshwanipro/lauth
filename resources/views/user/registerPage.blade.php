@extends('master.app')

@section('title')
    Register
@endsection

@section('pageTitle')
    <h1>Register Form</h1>
@endsection

@section('content')
    <form id="frm" action="{{ route('postRegister') }}" method="post">
        @csrf
        <div class="form-group">
            <label>First Name</label>
            <input class="form-control" type="text" name="fname" value="{{ old('fname') }}">
            <p class="text-danger">
                @error('fname')
                {{ $message }}
                @enderror
            </p>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="lname" value='{{ old('lname') }}'>
            <p class="text-danger">
                @error('lname')
                {{ $message }}
                @enderror
            </p>
        </div>
        <div>
            <label>Email</label>
            <input type="email" class="form-control" name="email" value='{{ old('email') }}'>
            <p class="text-danger">
                @error('email')
                {{ $message }}
                @enderror
            </p>
        </div>
        <div>
            <label>Password</label>
            <input type="password" class="form-control" name="password">
            <p class="text-danger">
                @error('password')
                {{ $message }}
                @enderror
            </p>
        </div>

        <input type="submit" class='btn btn-primary' name="submit">
        <a href="{{ route('home') }}" class='btn btn-primary'>Home</a>
        <p class='mt-1'>Already! have Account <a href="{{ route('loginPage') }}">Login</a></p>

    </form>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('#frm').validate({
                    rules: {
                       fname:{
                           required:true,
                       },
                       lname:{
                            required:true,
                       },
                       email:{
                            required:true,
                            email:true,
                        },
                        password:{
                            required:true,
                        }
                    },
                    messages: {
                        fname:{
                            required:'Please Enter First Name'
                        },
                        lname:{
                            required:'Please Enter Last Name'
                        },
                        email:{
                            required: 'please Enter the email',
                            email: 'please enter proper email',
                        },
                        password:{
                            required: 'please enter password',
                        },
                    },
                })
        })
    </script>
@endsection