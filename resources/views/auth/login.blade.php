@extends('auth/master')

@section('content')
    <div id="login">
        <div class="wrapper">
            <div class="text-center pt-2 pb-2">
                <h2 class="titleLogo">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Let's Calendar
                    </a>
                </h2>
            </div>

            {{-- @php print_r(session()->all()) @endphp --}}
            @if (session('error_message'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('error_message') }}
                </div>
            @endif



            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <div class="h2 font-weight-bold text-center mt-4 mb-4">Sign in or create account</div>
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <ul class="mb-0 list-unstyled">
                            <li>
                                {{ Session::get('error') }}
                                @php
                                    Session::forget('error');
                                @endphp
                            </li>
                        </ul>
                    </div>
                @endif
                <div class="form-group align-items-center">
                    <input type="email" name="email" value="{{ old('email') }}" autocomplete="off" class="form-control"
                        placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="err-text">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group align-items-center mb-2">
                    <input name="password" autocomplete="off" type="password" class="form-control" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="err-text">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="d-flex mb-4">
                    <a href="{{ url('forgot-password') }}" class="font-pwd mx-auto">Forgot Password</a>
                </div>
                <button type="submit" class="btn btn-primary mb-3">CONTINUE</button>

                <div class="terms mb-2">
                    Don't have an account?
                    <a href="{{ url('register') }}">Sign-Up</a>
                </div>
            </form>
        </div>
    </div>
@endsection
