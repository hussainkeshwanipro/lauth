@extends('master.app')

@section('title')
    Update Profile
@endsection

@section('pageTitle')
    <h1>Update Profile Form</h1>
@endsection

@section('content')
    <form id="frm" action="{{ route('userProfileUpdate') }}" method="POST">
        @csrf
      
        <div class="form-group">
            <label>First Name</label>
            <input class="form-control" type="text" name="fname" value="{{ $user->fname }}">
            <p class="text-danger">
                @error('fname')
                {{ $message }} 
                @enderror
            </p>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="lname" value="{{ $user->lname }}">
            <p class="text-danger">
                @error('lname')
                {{ $message }}
                @enderror
            </p>
        </div>
        <div>
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
            <p class="text-danger">
                @error('email')
                {{ $message }}
                @enderror
            </p>
        </div>
        

        <input type="submit" class='btn btn-primary' name="submit" value="update">
        <a href="{{ route('userProfile') }}" class="btn btn-primary">Home</a>
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
                        
                    },
                })
        })
    </script>
@endsection