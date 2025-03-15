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

</head>

<body>
    <div id="wrapper">
        <div id="page">
            {{ $slot }}
        </div>
    </div>
    <script src="{{ asset('user/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/bootstrap.min.js') }}"></script>
  
</body>

</html>
