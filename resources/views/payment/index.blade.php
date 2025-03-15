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
                <div class="row d-flex justify-content-center align-items-center min-vh-100">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Complete Your Payment</h4>
                            </div>
                            <div class="card-body p-4">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form id="payment-form" action="{{ route('stripe.process') }}" method="POST">
                                    @csrf
                                    <!-- Order details section -->
                                    <div class="mb-4 p-3 bg-light rounded">
                                        <h5 class="border-bottom pb-2 mb-3">Order Summary</h5>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Product:</span>
                                            <span class="fw-bold">Sample Product</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Amount:</span>
                                            <span class="fw-bold">$10.00</span>
                                        </div>
                                        <input type="hidden" name="amount" value="250">
                                    </div>

                                    <!-- Card details -->
                                    <div class="mb-4">
                                        <label for="card-element" class="form-label fw-bold">Card Information</label>
                                        <div id="card-element" class="form-control p-3"></div>
                                        <div id="card-errors" role="alert" class="text-danger mt-2 small"></div>
                                    </div>

                                    <button id="submit-button" class="btn btn-primary w-100 py-2 fw-bold">
                                        Pay $10.00 Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://js.stripe.com/v3/"></script>
            <script>
                // Create a Stripe client
                const stripe = Stripe('{{ config('services.stripe.key') }}');
                const elements = stripe.elements();

                // Custom styling for the card Element
                const style = {
                    base: {
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        },
                        padding: '10px 12px',
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                };

                // Create an instance of the card Element with custom options
                const cardElement = elements.create('card', {
                    style: style,
                    hidePostalCode: true // This removes the ZIP/postal code field
                });

                // Add an instance of the card Element into the `card-element` div
                cardElement.mount('#card-element');

                // Handle form submission
                const form = document.getElementById('payment-form');
                const submitButton = document.getElementById('submit-button');

                form.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    submitButton.disabled = true;
                    submitButton.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing...';

                    const {
                        paymentMethod,
                        error
                    } = await stripe.createPaymentMethod({
                        type: 'card',
                        card: cardElement,
                    });

                    if (error) {
                        // Display error
                        const errorElement = document.getElementById('card-errors');
                        errorElement.textContent = error.message;
                        submitButton.disabled = false;
                        submitButton.innerHTML = 'Pay $10.00 Now';
                    } else {
                        // Send the payment method ID to your server
                        const hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'paymentMethodId');
                        hiddenInput.setAttribute('value', paymentMethod.id);
                        form.appendChild(hiddenInput);

                        form.submit();
                    }
                });
            </script>
        </div>
    </div>
    <script src="{{ asset('user/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
