<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="{{ asset('argon/css/fonts.googleapis.css') }}" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

        <style>
            .flag-icon{
                max-height: 20px;
                max-width: 20px;
            }
            .modal_loading {
                display:    none;
                position:   fixed;
                z-index:    1000;
                top:        0;
                left:       0;
                height:     100%;
                width:      100%;
                background: rgba( 255, 255, 255, .8 )
                url({{asset('uploads/FhHRx.gif')}})
                50% 50%
                no-repeat;
            }
            body{
            /*   bg gray 100*/
                background-color: #e9ecef !important;
            }
            body.loading .modal_loading {
                overflow: hidden;
            }

            /* Anytime the body has the loading class, our
               modal element will be visible */
            body.loading .modal_loading {
                display: block;
            }
        </style>
        @yield('head')
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth

        <div class="main-content">
            <div class="modal_loading"><!-- Place at bottom of page --></div>
            @include('layouts.navbars.navbar')
            @yield('content')
{{--            @include('layouts.footers.auth')--}}
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest
        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        @stack('js')
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
        <script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

        @if(session('_message'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    type: "{{ session('_type') }}",
                    title: "{{ session('_message') }}",
                    showConfirmButton: false,
                    timer: {{session('_timer') ?? 5000}}
                });
            </script>
            @php(message_clear())
        @endif

    </body>
</html>
