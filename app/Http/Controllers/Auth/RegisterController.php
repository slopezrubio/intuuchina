<?php

namespace App\Http\Controllers\Auth;

use App\Rules\PhoneNumber;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Admin\NewUserNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Stripe\Checkout\Session as Checkout;
use Stripe\Stripe;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surnames' => ['required','string', 'max:255'],
            'email' => ['required', 'email_simple', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric', new PhoneNumber()],
            'nationality' => ['required', 'max:255'],
            'cv' => [Rule::requiredIf($data['program'] !== 'study'), 'file', 'max:2000', 'mimes:pdf,doc,docx,odt,zip'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms-register' => 'required',
        ],[
            'terms-register.required' => __('validation.custom.gdpr'),
            'cv.uploaded' => __('validation.custom.uploaded', ['file' => 'curriculum']),
            'cv.required' => __('validation.custom.required', ['attribute' => 'curriculum'])
        ]);

        $validator->after(function($validator) {

            if ($validator->errors()->has('email')) {
                $validator->errors()->add('register.email', $validator->errors()->first('email'));
            }
        });

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /*
         * Creates a new user into the database.
         */
        $user = User::create([
            'name' => $data['name'],
            'surnames' => $data['surnames'],
            'email' => $data['email'],
            'phone_number' => json_encode([
                'prefix' => $data['prefix'],
                'number' => $data['phone_number']
            ]),
            'nationality' => $data['nationality'],
            'program' => $data['program'],
            'industry' => isset($data['industry']) && $data['program'] === 'internship' || isset($data['industry']) && $data['program'] === 'inter_relocat' ? json_encode($data['industry']) : null,
            'study' => $data['program'] === 'study' && isset($data['study']) ? json_encode($data[$data['program']]) : null,
            'university' =>  $data['program'] === 'university' && !empty($data['university']) ? json_encode($data[$data['program']]) : null,
            'type' => 'user',
            'cv' => array_key_exists('cv', $data) ? $data['cv']->store('cv') : null,
            'status_id' => DB::table('states')
                            ->select(DB::raw('id'))
                            ->where('name', 'unverified')
                            ->get()->first()->id,
            'email_verified' => now(),
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
        ]);

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all(), $request->file('cv'))));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        /**
         * Adds the user to the customer list of Stripe, so it can be manage from the
         * Stripe dashboard.
         */
        /*$user->createAsStripeCustomer([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => __('prefixes.' . json_decode($user->phone_number)->prefix . '.prefix') . json_decode($user->phone_number)->number,
        ]);*/

        /*
         * Sends a notification to the admin.
         */
        $admins = User::getAdmins();

        Notification::send($admins, new NewUserNotification($user));
    }

    /**
     * Flashes a set of parameters into the session as to get the register form ready with the corresponding inputs loaded and
     * selected depending on the source where the request was made. Then redirects the user to the register form.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function registerWithOptions(Request $request) {
        session()->pull('options');
        session()->pull('program');
        session()->flash('options', $this->setOptions($request->all()));
        return redirect()->route('register');
    }

    /**
     * Creates the array is going to be flashed into the session by the @see registerWithOptions method.
     *
     * @param array $parameters
     * @return array
     */
    private function setOptions(Array $parameters) {
        $found = false;
        $options = [];
        while ($parameter = current($parameters) && $found !== true) {
            for ($y = 0; $y < count(__('content.programs')) && $found !== true; $y++) {
                $pattern = __('content.programs')[$y];
                if ($pattern ===  key($parameters)) {
                    $found = true;
                    $options[key($parameters)] = current($parameters);
                }
            }
            next($parameters);
        }

        $options['program'] = $parameters['program'];
        return $options;
    }
}
