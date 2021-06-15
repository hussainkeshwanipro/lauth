@extends('master.app')

@section('title')
   Profile 
@endsection

@section('pageTitle')
    <h1>Welcome, {{ $user->fname }}</h1>
   
    <a href="{{ route('userProfileEdit') }}" class='btn btn-primary'>Update Profile</a>
    <a href="{{ route('userProfileDelete') }}" class='btn btn-primary'>Delete Profile</a>
  
@endsection

@section('content')
    <form>

        <div class="form-group">
            <label>First Name</label>
            <input class="form-control" type="text" name="fname" value="{{ $user->fname }}" disabled>
            
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="lname" value='{{ $user->lname }}' disabled>            
        </div>
        <div class="form-group"> 
            <label>Email</label>
            <input type="email" class="form-control" name="email" value='{{ $user->email }}' disabled>
        </div> 

        <div class="form-group">
            <p>You want to Reset Password? <a href="{{ route('resetPasswordPage') }}">Click Hear</a></p>
        </div> 
    </form>


    

@endsection

