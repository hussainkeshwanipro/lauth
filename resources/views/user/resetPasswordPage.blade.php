@extends('master.app')

@section('title')
   Profile 
@endsection

@section('pageTitle')
    <h1>Reset Password, {{ $user->fname }}</h1>
    <a href="{{ route('userProfile') }}" class="btn btn-primary">Home</a>
@endsection

@section('content')
    <form method="post" action="{{ route('postEmail')}}">
        @csrf
        <div class="form-group"> 
            <label>Email</label>
            <input type="email" class="form-control" name="email"  value='{{ $user->email }}'>
        </div> 

        <div class="form-group">
            To Reset password <input type="submit" class="btn btn-primary btn-sm"value="Send Link!" name="reset">
        </div> 
    </form>

@endsection