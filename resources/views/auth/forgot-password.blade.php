@extends('auth/master')

@section('content')
<div id="forgot-password">
    <div class="wrapper">
        <div class="text-center pt-2 pb-2">
            <h2 class="titleLogo">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Let's Calendar
                </a>
            </h2>
        </div>
        <form method="POST" action="{{ route('reset.password.request') }}">
            @csrf
            <div class="h2 font-weight-bold text-center mt-4 mb-4">Recover Password</div>

            <div class="form-group d-flex align-items-center">
                <input name="email" autocomplete="off" type="email" class="form-control" placeholder="Email">
            </div>
            <button class="btn btn-primary mt-3 mb-3">Submit</button>
            
            
            <div class="terms mb-2">
                Do you remember the password?
                <a href="{{url('login')}}">Login</a>
            </div>
        </form>
    </div>
</div>
@endsection