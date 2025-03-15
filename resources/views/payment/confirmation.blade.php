<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('user/assets/icon/Favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('user/assets/icon/Favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <div id="wrapper">
        <div id="page">
            <div class="container">
                <div class="row justify-content-center align-items-center min-vh-100">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h4 class="mb-0">Payment Successful!</h4>
                            </div>
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                                </div>

                                <div class="p-3 bg-light rounded mb-4">
                                    <h5 class="border-bottom pb-2 mb-3">Payment Details</h5>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Transaction ID:</span>
                                        <span class="fw-bold">{{ $payment['id'] }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Amount:</span>
                                        <span class="fw-bold">${{ number_format($payment['amount'] / 100, 2) }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Date:</span>
                                        <span class="fw-bold">{{ date('F j, Y g:i A', $payment['created']) }}</span>
                                    </div>


                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Status:</span>
                                        <span class="fw-bold text-success">{{ ucfirst($payment['status']) }}</span>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a href="{{ route('home') }}" class="btn btn-primary">Return to Homepage</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('user/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/bootstrap.min.js') }}"></script>

</body>

</html>
