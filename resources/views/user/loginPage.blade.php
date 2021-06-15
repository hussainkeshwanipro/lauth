@extends('master.app')

@section('title')
    Login
@endsection

@section('pageTitle')
    <h1>Login Form</h1>
@endsection

@section('content')
    <form id="frm"action="{{ route('postLogin') }}" method="post">
        @csrf
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

       

        <input type="submit" class='btn btn-primary' value="Login" name="submit">
        <a href="{{ route('home') }}" class='btn btn-primary'>Home</a>

        <p class='mt-1'>Don't have Account <a href="{{ route("registerPage") }}">Register!</a></p>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#frm').validate({
                    rules: {
                        email:{
                            required:true,
                            email:true,
                        },
                        password:{
                            required:true,
                        }
                    },
                    messages: {
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