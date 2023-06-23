<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-theme hydrated color-header headercolor8">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title> @yield('title') | {{ env('APP_NAME') }}</title>
    @include('layouts.components.head')

</head>
@section('body')
<body>
    @show
    @include('layouts.components.header')
    <div class="container-fluid">
        <div class="row">
            @include('layouts.components.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>
    @include('layouts.components.footer-script')

</body>

</html>
