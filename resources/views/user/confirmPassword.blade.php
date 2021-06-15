@extends('master.app')

@section('title')
    New Password
@endsection

@section('pageTitle')
    <h1>Confirm Password</h1>
@endsection

@section('content')
    <form id="frm" action="{{ route('postConfirmPasswordPage') }}" method="post">
        @csrf
        <div>
            <label>New Password</label>
            <input type="password" class="form-control" name="newpassowrd">
            <p class="text-danger">
                @error('newpassowrd')
                {{ $message }}
                @enderror
            </p>
        </div>

        <input type="hidden" name="paswordToken" value="{{ $token }}">
        

        <input type="submit" class='btn btn-primary' value="update" name="update">
        <a href="{{ route('userProfile') }}" class='btn btn-primary'>Home</a>

    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#frm').validate({
                    rules: {
                        
                        newpassowrd:{
                            required:true,
                        }
                    },
                    messages: {
                       
                        newpassowrd:{
                            required: 'please enter password',
                        },
                    },
                })
        })
    </script>
@endsection
