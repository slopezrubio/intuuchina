<?php

namespace App\Http\Controllers;

use App\Notifications\NewPaymentNotification;
use App\Rules as Assert;
use App\Mail\InvoicePaid;
use App\Rules\InPersonCoursesScope;
use App\Rules\OnlineCoursesScope;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session as Checkout;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Invoice;
use Stripe\InvoiceItem;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\CardException;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use App\User;

class CheckoutsController extends Controller
{
    const APPLICATION_FEE = 30.00;

    protected $session;

    /**
     * Display the «Application Fee» payment form to the user.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws ApiErrorException
     */
    public function applicationFeeForm()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $intent = PaymentIntent::create([
                'amount' => $this->convertToSmallerUnitOfMeasure(self::APPLICATION_FEE),
                'currency' => config('services.stripe.cashier_currency')
            ]);
        } catch(Exception $e) {
            throwException($e->getMessage());
        }

        $currencies = __('currencies');

        return view('components.forms.dialog-box-application-fee', compact('intent', 'currencies'));
    }

    public function chineseCoursePayment()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $user = Auth::user();
        $selectedCourse = array_keys(__('content.courses'))[0];

        if($user->hasChineseStudies()) {
            $selectedCourse = $user->getStudies()[0];
        }

        try {
            $intent = PaymentIntent::create([
                'amount' => $this->convertToSmallerUnitOfMeasure(__('content.courses.' . $selectedCourse . '.price.eur')),
                'currency' => config('services.stripe.cashier_currency')
            ]);
        } catch(Exception $e) {
            throwException($e->getMessage());
        }

        $currencies = __('currencies');

        return view('components.forms.dialog-box-study-payment', compact('intent', 'currencies'));
    }

    /**
     * Creates a new Stipe Payment Intent with the payment method got from the
     * user request.
     *
     * @param Request $request
     * @return array|ResponseFactory|Response|string
     * @throws ApiErrorException
     */
    public function newPaymentIntent(Request $request)
    {
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

                $course = $this->getCourseSelected($request->all());

                $payment_method = PaymentMethod::retrieve($payment_method);
                $payment_method->attach([
                    'customer' => $user->stripe_id
                ]);

                $invoice = $this->getPaymentInvoice([
                    'customer' => $user->stripe_id,
                    'amount' =>  $this->getPaymentAmount($request->all()),
                    'currency' => config('services.stripe.cashier_currency'),
                    'description' =>  __('content.invoice.' . $user->program . '.description'),
                    'customer_email' => $request->get('email'),
                    'customer_phone' => $request->get('phone_number'),
                    'metadata' => [
                        'program' => __('content.programs.' . $user->program),
                        'course' => $request->get('study') !== null ? $request->get('study') : null,
                        'duration' => $course['duration'] !== null ? $course['duration'] : null,
                    ],
                    'payment_method' => $payment_method ->id,
                ]);

                // Retrieves the Payment Intent.
                $intent = PaymentIntent::retrieve($invoice->payment_intent);

                $intent->confirm();
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
             * extracting the parameter in which the error is related to.
             */
            if ($e->getStripeParam() !== null) {
                $response['error']['field'] = $e->getStripeParam();
            }

            return $response;
        }
    }

    public function validatePaymentDetails(Request $request)
    {
        $rules = [
            'card_holder_name' => ['required', 'string', new Assert\ValidName],
            'phone_number' => ['required', 'numeric', new Assert\PhoneNumber],
            'email' => 'required|email:rfc',
        ];

        // Get the course selected by the user.
        $course = $this->getCourseSelected($request->all());

        /*
         * If there is a course selected, pushes the corresponding
         * rules to the array of rules.
         */
        if ($course !== null) {
            $rules[$course['field']] = $course['rules'];
        }

        // Makes the validators for each field.
        $validator = Validator::make($request->all(), $rules);

        // Return errors messages.
        $validator->validate();

        /*
         * In case validations succeed, returns the billing details
         * which are going to be send it afterward in the client side.
         */
        $billingDetails = [
            'name' => $request->get('card_holder_name'),
            'phone' => $request->get('phone_number'),
            'email' => $request->get('email'),
        ];

        return response()
                ->json($billingDetails);
    }

    /**
     * Get the course selected by the user in the payment form.
     *
     * @param $data
     * @return array|null
     */
    public function getCourseSelected($data) {
        $course = null;

        if (array_key_exists('study', $data)) {
            switch($data['study']) {
                case 'in-person':
                    $course = [
                        'field' => 'staying',
                        'duration' => $data['staying'],
                        'rules' => ['required', 'numeric', new InPersonCoursesScope()],
                        'amount' => intval(__('content.courses.' . $data['study'] . '.price.' . config('services.stripe.cashier_currency'))) * $data['staying'],
                    ];
                    break;
                case 'online':
                    $course = [
                        'field' => 'hours',
                        'duration' => $data['hours'],
                        'rules' => ['required', 'numeric', new OnlineCoursesScope()],
                        'amount' => intval(__('content.courses.' . $data['study'] . '.price.' . config('services.stripe.cashier_currency'))) * $data['hours'],
                    ];
                    break;
            }
        }

        return $course;
    }

    /**
     * Gets the corresponding payment amount according to the program
     * and the duration selected.
     *
     * @param $data
     * @return float|int
     */
    private function getPaymentAmount($data)
    {
        $course = $this->getCourseSelected($data);
        $amount = $course !== null ? $course['amount'] : self::APPLICATION_FEE;
        return $this->convertToSmallerUnitOfMeasure($amount);
    }

    public function convertToSmallerUnitOfMeasure($value)
    {
        $multiplier = intval('1e'. __('currencies.' . config('services.stripe.cashier_currency') . '.decimal_digits'));
        return $value * $multiplier;
    }

    /**
     * Generates the corresponding Invoice for the given PaymentIntent.
     *
     * @param array $options
     * @param PaymentIntent $intent
     * @return Invoice
     * @throws ApiErrorException
     */
    private function getPaymentInvoice(array $options) :Invoice
    {
        InvoiceItem::create([
            'customer' => $options['customer'] !== null ? $options['customer'] : Auth::user()->stripe_id,
            'currency' => config('services.stripe.cashier_currency'),
            'amount' => $options['amount'],
        ]);

        return Invoice::create([
            'customer' => $options['customer'] !== null ? $options['customer'] : Auth::user()->stripe_id,
            'description' => isset($options['description']) ? $options['description'] : null,
            'default_payment_method' => $options['payment_method'],
            'metadata' => $options['metadata'],
        ])->finalizeInvoice();
    }

    /**
     *
     *
     * @param $intent
     * @return array|ResponseFactory|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View|string|void
     * @throws ApiErrorException
     */
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
            // Auth::user()->updateStatus('paid');
            $receipt_url =  $intent->charges->data[count($intent->charges->data) - 1]->receipt_url;

            $user = Auth::user();

            try {
                $invoice = Invoice::retrieve($intent->invoice);

                if ($invoice->custom_fields['course'] !== null) {
                    $user->addPreference('study', $invoice->custom_fields->course);
                }

                Mail::to($invoice->customer_email)
                    ->queue(new InvoicePaid($invoice, $user));


                $admins = User::getAdmins();

                /*
                 * Sends a notification message to all the admins to report
                 * a new user has made the corresponding payment.
                 */
                Notification::send($admins, new NewPaymentNotification($user, $invoice));

            } catch(\Exception $e) {

                return $e->getMessage();
            }


            // Redirects the user to the paid dialog box to report the user about
            // the successful payment.
            return view('components/forms/dialog-box-payment-succeeded', compact('receipt_url'));

        } else {
            // Invalid status.
            return response([
                'error' => 'Invalid PaymentIntent status'
            ], 500)
                ->header('Content-Type', 'json/application');
        }
    }

    //    public function newCheckout($id, $hashedProperty) {
//        $user = User::find($id);
//
//        // Set Stripe API key to proceed with the Checkout Session.
//        Stripe::setApiKey(config('services.stripe.secret'));
//
//        /**
//         * Creates a Checkout Session according to the chosen program.
//         */
//        $stripeSession = Checkout::create([
//            'cancel_url' => route('home'),
//            'customer' => $user->stripe_id,
//            'line_items' => [
//                [
//                    'name' => 'Application Fee',
//                    'amount' => 3000,
//                    'currency' => 'eur',
//                    'description' => 'Application Fee for ' . $user->name . ' ' . $user->surnames,
//                    'quantity' => '1',
//                ]
//            ],
//            'locale' => config('app.locale'),
//            'mode' => 'payment',
//            'payment_method_types' => ['card'],
//            'submit_type' => 'pay',
//            'success_url' => route('home'),
//        ]);
//    }
}
