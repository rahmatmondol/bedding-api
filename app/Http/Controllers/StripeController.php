<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Exception;

class StripeController extends Controller
{
    public function processPayment(Request $request)
    {
        try {
            // Set your secret key
            Stripe::setApiKey(config('services.stripe.secret'));

            // Get the payment method ID from the form
            $paymentMethodId = $request->paymentMethodId;

            // Create a payment intent with proper configuration
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Amount in cents
                'currency' => 'usd',
                'payment_method' => $paymentMethodId,
                'confirm' => true,
                'description' => 'Payment for product/service',
                'receipt_email' => null, // No email receipt
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never'
                ],
                'return_url' => route('payment.confirmation') // Update this to the confirmation route
            ]);

            // If the payment requires action (like 3D Secure)
            if ($paymentIntent->status === 'requires_action') {
                return redirect()->back()->with('error', 'This payment requires additional verification. Please try a different card.');
            }

            // If the payment is successful, retrieve the payment details
            if ($paymentIntent->status === 'succeeded') {
                // Retrieve the complete payment details
                $payment = \Stripe\PaymentIntent::retrieve($paymentIntent->id);

                // Store payment details in the session
                session(['payment_details' => $payment->toArray()]);

                // Redirect to the confirmation page
                return redirect()->route('payment.confirmation');
            }

            return redirect()->back()->with('error', 'Payment was not successful. Please try again.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showConfirmation(Request $request)
    {
        // Retrieve the payment details from the session
        $payment = session('payment_details');

        // If no payment details are found, redirect to the payment page
        if (!$payment) {
            return redirect()->route('payment')->with('error', 'No payment information found.');
        }

        return view('payment.confirmation', compact('payment'));
    }
}
