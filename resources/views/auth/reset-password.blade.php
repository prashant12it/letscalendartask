@extends('auth/master')

@section('content')
<div id="signup">
    <div class="wrapper">
    <div class="text-center pt-2 pb-2">
        <h2 class="titleLogo">
            <a class="navbar-brand" href="{{ url('/') }}">
                Let's Calendar
            </a>
        </h2>
        </div>

        @if(Session::has('error'))
            <div class="err-text mt-1">
                {{ Session::get('error') }}
                @php
                    Session::forget('error');
                @endphp
            </div>
        @endif
       
        <div class="h2 font-weight-bold text-center mb-2 pt-4 ">Reset Password</div>
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <div class="block">
                <div class="form-group d-flex align-items-center">
                    <input class="form-control" class="block mt-1 w-full" type="email"  value="{{base64_decode($email)}}" required disabled autofocus />
                    <input type="hidden" name="email" value="{{$email}}">
                </div>

                <div class="form-group d-flex align-items-center">
                    <input name="password" autocomplete="off" type="password" class="form-control"  placeholder="Password">
                </div>

                <div class="form-group d-flex align-items-center">
                    <input name="cpassword" autocomplete="off" type="password" class="form-control" placeholder="Confirm Password">
                </div>

                <button class="btn btn-primary mt-3 mb-3">SUBMIT</button>
            </div>
        </form>
    </div>
</div>
@endsection