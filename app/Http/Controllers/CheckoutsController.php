<?php

namespace App\Http\Controllers;

use App\Category;
use App\Fee;
use App\FeeType;
use App\Notifications\NewPaymentNotification;
use App\Rules as Assert;
use App\Mail\InvoicePaid;
use App\Rules\InPersonCoursesScope;
use App\Rules\OnlineCoursesScope;
use App\Status;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use Stripe\Charge;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\InvalidRequestException;
use Stripe\PaymentIntent;
use Stripe\Invoice;
use Stripe\InvoiceItem;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\CardException;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Stripe\TaxRate;
use App\User;
use Whoops\Exception\ErrorException;

class CheckoutsController extends Controller
{

    protected $session;
    protected $fee;
    protected $total;
    protected $subtotal;

    public static function toStripeUnit($value, $currency = null) {
        if ($currency !== null) {
            return $value * intval('1e'.__('currencies.'.$currency.'.decimal_digits'));
        }

        return $value * intval('1e'.__('currencies.'.config('services.stripe.cashier_currency').'.decimal_digits'));
    }

    public function setPaymentValues($category = null) {
        $this->fee = Auth::user()->getFirstCategory()->fee;

        if ($category !== null) {
            $this->fee = Category::where('value', $category)->first()->fee;
        }

        $this->subtotal = $this->fee->minimum !== null ? $this->fee->amount * $this->fee->minimum : $this->fee->amount;

        $this->total = $this->subtotal + ($this->subtotal * floatval($this->fee->getTaxRate()['percentage'] / 100));

        return $this;
    }

    public function processPayment(Request $request) {
        Stripe::setApiKey(config('services.stripe.secret'));

        $this->setPaymentValues();

        try {
            $intent = PaymentIntent::create([
                'amount' => self::toStripeUnit($this->total),
                'currency' => config('services.stripe.cashier_currency')
            ]);
        } catch(ApiErrorException $e) {
            return $e->getMessage();
        }

        $view = $request->ajax() ? 'partials.dialogs.user._payment' : 'pages.user.payment';

        return view($view, [
            'currencies' => __('currencies'),
            'intent' => $intent,
            'fee' => $this->fee,
            'total' => $this->total,
            'subtotal' => $this->subtotal,
        ]);
    }

    public function getPaymentFee(Request $request) {
        $course = $request->get('course') !== null ? $request->get('course') : null;

        if ($course !== null) {
            return Category::where('value', $course)->first()->fee;
        }

        return Auth::user()->categories->count() > 0
            ? Auth::user()->categories->first()->fee
            : Auth::user()->program->feeType->fees->first();
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

        $this->fee = Auth::user()->categories->count() > 0
                        ? Auth::user()->categories->first()->fee
                        : Auth::user()->program->feeType->fees->first();

        if ($request->get('course') !== null ) {
            $this->fee = Category::where('value', $request->get('course'))->first()->fee;
        }

        $intent = null;
        $dialog = $request->get('dialog') ? $request->get('dialog') : null;
        $payment_method = $request->get('payment_method') ? $request->get('payment_method') : null;
        $payment_intent_id = $request->get('payment_intent_id') ? $request->get('payment_intent_id') : null;

        try {
            // Check if the Payment Method has been sent.
            if ($payment_method !== null) {

                $user = Auth::user();

                if (!$user->hasStripeId()) {
                    $user->createAsStripeCustomer([
                        'name' => $request->get('card_holder'),
                        'phone' => $user::e164NumberFormat([
                            'prefix' => $request->get('prefix'),
                            'number' => $request->get('phone_number'),
                        ]),
                    ]);
                };

                $payment_method = PaymentMethod::retrieve($payment_method);
                $payment_method->attach([
                    'customer' => $user->stripe_id
                ]);

                $this->setPaymentValues($request->get('course'));

                $invoice = $this->getPaymentInvoice([
                    'customer' => $user->stripe_id,
                    'amount' =>  self::toStripeUnit($this->total),
                    'currency' => config('services.stripe.cashier_currency'),
                    'description' =>  $this->fee->name,
                    'customer_name' => $request->get('card_holder'),
                    'customer_email' => $request->get('email'),
                    'customer_phone' => $request->get('phone_number'),
                    'quantity' => $request->get('quantity') !== null ? intval($request->get('quantity')) : 1,
                    'metadata' => [
                        'program' => Auth::user()->program->value,
                        'fee' => $this->fee->id,
                        'course' => $request->get('course') !== null ? $request->get('course') : null,
                    ],
                    'payment_method' => $payment_method->id,
                ]);

                // Retrieves the Payment Intent.
                $intent = PaymentIntent::retrieve($invoice->payment_intent);

                $intent->confirm();
            };

            // Check if the Payment Intent has been sent.
            if ($payment_intent_id != null) {

                // Gets the Payment Intent ID and confirms the payment.
                $intent = PaymentIntent::retrieve($payment_intent_id);

                // Check for a confirmation if necessary
                if ($intent->status !== 'succeeded') {
                    $intent->confirm();
                }
            };

            if (Auth::user()->status->name === 'paid') {
                return $intent->charges->data[count($intent->charges->data) - 1]->receipt_url;
            }

            $response = $this->generateStripeResponse($intent, $dialog);

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

    public function showPaymentConfirmation($charge) {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::retrieve($charge);

            if ($charge->customer === Auth::user()->stripe_id) {
                return view('pages.user.payment-confirmation', [
                    'receipt_url' => $charge->receipt_url
                ]);
            }
        } catch(InvalidRequestException|ErrorException $exception) {
            return response()->view('errors.404', [], 403);
        }
    }

    public function validatePaymentDetails(Request $request)
    {
        $rules = [
            'card_holder' => ['required', 'string', new Assert\ValidName],
            'phone_number' => ['required', 'numeric', new Assert\PhoneNumber],
            'email' => 'required|email:rfc',
        ];

        $course = $request->get('course');

        /*
         * If there is a course selected, pushes the corresponding
         * rules to the array of rules.
         */
        if ($course !== null) {
            $courseValidationRuleClass = '\\App\\Rules\\' . Str::studly($course) . 'CoursesScope';

            $newFee = Category::where('value', $course)->first()->fee;
            $rules[Str::plural($newFee->unit)] = new $courseValidationRuleClass($newFee);
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
            'name' => $request->get('card_holder'),
            'phone' => $request->get('phone_number'),
            'email' => $request->get('email'),
        ];

        return response()
                ->json($billingDetails);
    }

    /**
     * Generates the corresponding Invoice for the given PaymentIntent.
     *
     * @param array $options
 * @return string
     * @throws ApiErrorException
     */
    private function getPaymentInvoice(array $options)
    {
        $fee = Fee::find($options['metadata']['fee']);

        try {
            InvoiceItem::create([
                'customer' => $options['customer'] !== null ? $options['customer'] : Auth::user()->stripe_id,
                'currency' => config('services.stripe.cashier_currency'),
                'quantity' => $options['quantity'],
                'unit_amount_decimal' => self::toStripeUnit($fee->amount),
            ]);

            return Invoice::create([
                'customer' => $options['customer'] !== null ? $options['customer'] : Auth::user()->stripe_id,
                'description' => isset($options['description']) ? $options['description'] : null,
                'default_payment_method' => $options['payment_method'],
                'metadata' => $options['metadata'],
                'default_tax_rates' => [
                    TaxRate::create($fee->getTaxRate())->id
                ],
            ])->finalizeInvoice();

        } catch(ApiErrorException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $intent
     * @param null $dialog
     * @return array|ResponseFactory|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View|string|void
     */
    private function generateStripeResponse($intent, $dialog = null) {
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

            $receipt_url = $intent->charges->data[count($intent->charges->data) - 1]->receipt_url;

            $user = Auth::user();

            try {
                $invoice = Invoice::retrieve($intent->invoice);



                if ($invoice->metadata['course'] !== null) {
                    $user->categories()->sync([
                        Category::where('value', $invoice->metadata['course'])->first()->id
                    ]);
                }

                $user->update([
                    'status_id' => Status::where('value', 'paid')->first()->id,
                ]);

                $user = User::find($user->id);

                Mail::to($invoice->customer_email)
                    ->send(new InvoicePaid($invoice, $user));

                $admin = User::admins()->first();

                /*
                 * Sends a notification message to all the admins to report
                 * a new user has made the corresponding payment.
                 */
                $admin->notify(new NewPaymentNotification($user, $invoice));

            } catch(\Exception $e) {
                return $e->getMessage();
            }

            // Redirects the user to the paid dialog box to report the user about
            // the successful payment.
            if ($dialog !== null) {
                return view('partials.dialogs.user._' . $user->status->value, [
                    'receipt_url' => $receipt_url,
                ]);
            }

            return $intent;
        } else {
            // Invalid status.
            return response([
                'error' => 'Invalid PaymentIntent status'
            ], 500)
                ->header('Content-Type', 'json/application');
        }
    }
}
