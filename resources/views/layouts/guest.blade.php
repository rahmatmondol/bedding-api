<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Bidding') }}</title>

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/assets/css/style.css') }}">

    <!-- Reponsive -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/assets/css/responsive.css') }}">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('user/assets/icon/Favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('user/assets/icon/Favicon.png') }}">
</head>

<body class="body counter-scroll sticky-scroll1">

    <!-- preload -->
    <div class="preload preload-container">
        <div class="middle">
            <div class="bar bar1"></div>
            <div class="bar bar2"></div>
            <div class="bar bar3"></div>
            <div class="bar bar4"></div>
            <div class="bar bar5"></div>
            <div class="bar bar6"></div>
            <div class="bar bar7"></div>
            <div class="bar bar8"></div>
        </div>
    </div>
    <!-- /preload -->

    <div id="wrapper">
        <div id="page" class="home-7">
            @include('layouts.header')
            {{ $slot }}
            @include('layouts.footer')
        </div>
    </div>
    <!-- /#page -->


    </div>
    <!-- /#wrapper -->

    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;">
            </path>
        </svg>
    </div>
    <!-- Javascript -->
    <script src="{{ asset('user/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/swiper.js') }}"></script>
    {{-- <script src="{{ asset('user/assets/js/countto.js') }}"></script> --}}
    <script src="{{ asset('user/assets/js/count-down.js') }}"></script>

    <script src="{{ asset('user/assets/js/simpleParallax.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/gsap.js') }}"></script>
    <script src="{{ asset('user/assets/js/SplitText.js') }}"></script>
    <script src="{{ asset('user/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/ScrollTrigger.js') }}"></script>
    <script src="{{ asset('user/assets/js/gsap-animation.js') }}"></script>
    <script src="{{ asset('user/assets/js/tsparticles.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/tsparticles.js') }}"></script>
    <script src="{{ asset('user/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>


</html>
