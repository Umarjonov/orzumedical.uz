<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Xitoy Savdo Markazi') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    {{--    <meta content="Free HTML Templates" name="keywords">--}}
    {{--    <meta content="Free HTML Templates" name="description">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="{{ asset('argon/css/fonts.googleapis.css') }}" rel="stylesheet">
{{--    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"--}}
{{--          rel="stylesheet">--}}
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @yield('head')
    <style>
        .higher-z-index {
            z-index: 10;
        }
    </style>
</head>

<body>
@include('layouts.main.topbar')

<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        @include('layouts.main.categories', ['catalogs' => $catalogs])
        <div class="col-lg-9">
            @include('layouts.main.navbar')
            @if(Route::currentRouteName()=='welcome')
                @include('layouts.components.header_carousel', ['carousels' => $carousels])
            @endif
        </div>
    </div>
</div>
<!-- Navbar End -->
@yield('content')

@include('layouts.main.footer')

<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

@stack('js')
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
<!-- JavaScript Libraries -->
<script src="{{asset('assets/js/easing.min.js') }}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js') }}"></script>

<!-- Contact Javascript File -->
<script src="{{asset('assets/js/jqBootstrapValidation.min.js') }}"></script>
<script src="{{asset('assets/js/contact.js') }}"></script>

<!-- Template Javascript -->
<script src="{{asset('assets/js/main.js') }}"></script>
</body>

</html>
