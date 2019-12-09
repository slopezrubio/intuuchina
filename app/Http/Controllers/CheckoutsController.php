<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use App\Rules as Assert;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Charge;
use Stripe\Invoice;
use Stripe\InvoiceItem;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\CardException;
use Stripe\Stripe;

class CheckoutsController extends Controller
{
    const APPLICATION_FEE = 3000;

    protected $session;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function applicationFeeForm()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $intent = PaymentIntent::create([
                'amount' => self::APPLICATION_FEE,
                'currency' => config('services.stripe.cashier_currency')
            ]);
        } catch(Exception $e) {
            throwException($e->getMessage());
        }

        $currencies = __('currencies');

        return view('partials/forms/dialog-box-application-fee', compact('intent', 'currencies'));
    }

    /**
     * Creates a new Stipe Payment Intent with the payment method got from the
     * user request.
     *
     * @param Request $request
     * @return array|ResponseFactory|Response|string
     * @throws ApiErrorException
     */
    public function newPaymentIntent(Request $request) {
        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = null;
        $payment_method = $request->get('payment_method') ? $request->get('payment_method') : null;
        $payment_intent_id = $request->get('payment_intent_id') ? $request->get('payment_intent_id') : null;

        try {

            // Check if the Payment Method has been sent.
            if ($payment_method !== null) {

                $user = Auth::user();

                if (!$user->hasStripeId()) {
                    $user->createAsStripeCustomer();
                };

                // Creates the Payment Intent with the provided Payment Method ID.
                $intent = PaymentIntent::create([
                    'payment_method' => $payment_method,
                    'amount' => $request->get('amount'),
                    'currency' => $request->get('currency'),
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                    'description' => __('content.application fee'),
                    'receipt_email'=> $request->get('email'),
                ]);
            };

            // Check if the Payment Intent has been sent.
            if ($payment_intent_id != null) {
                // Gets the Payment Intent ID and confirms the payment.
                $intent = PaymentIntent::retrieve($payment_intent_id);
                $intent->confirm();
            };

            $response = $this->generateStripeResponse($intent);
            return $response;
        } catch (CardException $e) {

            $response = [
                'error' => [
                    'field' => 'submit',
                    'message' => $e->getMessage(),
                ]
            ];

            /**
             * Checks if the error is associated with a particular form field by
             * extracting the parameter the error is related to.
             */
            if ($e->getStripeParam() !== null) {
                $response['error']['field'] = $e->getStripeParam();
            }

            return $response;
        }
    }

    /**
     * Validates the billing details for a Payment Method.
     *
     * @param Request $request
     */
    public function validateBillingDetails(Request $request) {
        $request->validate([
            'card_holder_name' => ['required', 'string', new Assert\ValidName],
            'phone_number' => ['required', 'numeric', new Assert\PhoneNumber],
            'email' => 'required|email:rfc,dns',
        ]);
    }

    public function test() {
        return view('partials/forms/dialog-box-payment-succeeded');
    }

    private function generateStripeResponse($intent) {
        // Note that if your API version is before 2019-02-11, 'requires_action'
        // appears as 'requires_source_action'.
        if ($intent->status == 'requires_action' &&
            $intent->next_action->type == 'use_stripe_sdk') {

            // Tell the client to handle the action
            return [
                'requires_action' => true,
                'payment_intent_client_secret' => $intent->client_secret
            ];
        } else if ($intent->status == 'succeeded') {
            // The payment didn’t need any additional actions and completed!
            // Handle post-payment fulfillment

            // Now the user has paid and his state must be updated.
//            Auth::user()->updateStatus('paid');
            $receipt_url =  $intent->charges->data[count($intent->charges->data) - 1]->receipt_url;

            // Redirects the user to the paid dialog box to report the user about
            // the successful payment.
            return view('partials/forms/dialog-box-payment-succeeded', compact('receipt_url'));

        } else {
            // Invalid status.
            return response([
                'error' => 'Invalid PaymentIntent status'
            ], 500)
                ->header('Content-Type', 'json/application');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
