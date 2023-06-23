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
            <div class="text-danger mt-1">
                {{ Session::get('error') }}
                @php
                    Session::forget('error');
                @endphp
            </div>
        @endif

        @csrf
        <div class="h2 font-weight-bold text-center mb-2 pt-4 ">Verify your account</div>
        
        <div class="mb-4 text-sm text-white">
            {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif
            
        {{-- <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <button class="btn btn-primary mb-3">
                        {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>
        </div> --}}
    </div>
</div>
@endsection