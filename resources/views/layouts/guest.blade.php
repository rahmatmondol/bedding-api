<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/responsive.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('user/assets/icon/Favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('user/assets/icon/Favicon.png') }}">

    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css"
        integrity="sha512-6c4nX2tn5KbzeBJo9Ywpa0Gkt+mzCzJBrE1RB6fmpcsoN+b/w/euwIMuQKNyUoU/nToKN3a8SgNOtPrbW12fug=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div id="wrapper">
        <div id="page">
            <!-- SweetAlert Session Flash Messages -->
            @if (session()->has('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}',
                    });
                </script>
            @endif

            @if (session()->has('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ session('error') }}',
                    });
                </script>
            @endif

            <!-- Page Content -->
            @include('layouts.header')
            {{ $slot }}
            @include('layouts.footer')
        </div>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('user/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/swiper.js') }}"></script>
    <script src="{{ asset('user/assets/js/countto.js') }}"></script>
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
    <script>
        window.addEventListener('swal', event => {
            Swal.fire({
                icon: event.detail.icon,
                title: event.detail.title,
                text: event.detail.text,
            });
        });
    </script>
</body>

</html>
