@extends('master.app')

@section('title')
   Profile 
@endsection

@section('pageTitle')
   <h1>Select Option to contiune</h1>
@endsection

@section('content')
 <a href="{{ route('loginPage') }}" class="btn btn-primary btn-lg">Login</a>
 <a href="{{ route('registerPage') }}" class="btn btn-primary btn-success btn-lg">Register</a>
@endsection