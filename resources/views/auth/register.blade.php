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

        <form method="POST" action="{{ route('auth.register') }}">
            @csrf
            <div class="h2 font-weight-bold text-center mt-4 mb-4">Sign-Up</div>
            <div class="form-group align-items-center">
                <input name="name" autocomplete="off" type="text" class="form-control" placeholder="Name">
                @if ($errors->has('name'))
                    <span class="err-text">{{ $errors->first('name') }}</span>
                @endif
            </div>
            
            <div class="form-group align-items-center">
                <input name="email" autocomplete="off" type="email" class="form-control" placeholder="Email">
                @if ($errors->has('email'))
                    <span class="err-text">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group align-items-center">
                <input name="mobile" autocomplete="off" type="tel" class="form-control" placeholder="Phone">
                @if ($errors->has('mobile'))
                    <span class="err-text">{{ $errors->first('mobile') }}</span>
                @endif
            </div>
            <button class="btn btn-primary mt-3 mb-3">Signup</button>
            
            <div class="terms mb-2">
                Already have an account?
                <a href="{{url('login')}}">Login</a>
            </div>
        </form>
    </div>
</div>
@endsection