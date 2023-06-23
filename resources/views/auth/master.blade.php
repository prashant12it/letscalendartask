<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{asset('bootstrap-5.3.0/css/bootstrap.min.css')}}" type="text/css"
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Source+Sans+Pro&display=swap" rel="stylesheet"/>

        {{-- <link
            rel="stylesheet"
            href="{{asset('fontawesome/css/fontawesome.min.css')}}"
            type="text/css"
        />
        <link
                rel="stylesheet"
                href="{{asset('fontawesome/css/brands.min.css')}}"
                type="text/css"
        />
        <link
                rel="stylesheet"
                href="{{asset('fontawesome/css/solid.min.css')}}"
                type="text/css"
        /> --}}
        <link
                rel="stylesheet"
                href="{{asset('css/style.css')}}"
                type="text/css"
        />
        <link
                rel="stylesheet"
                href="{{asset('css/login.css')}}"
                type="text/css"
        />

        <!-- Styles -->
        @yield('styles')
    </head>
    <body class="main-bg">
        <main>
            <div>
              <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @yield('content')
                        </div>
                    </div>
              </div>
            </div>
        </main>  
        
        <script
              src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
              integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
              crossorigin="anonymous"
        ></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        
        @stack('page-scripts')
    </body>
</html>


