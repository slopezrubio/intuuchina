<?php

namespace App\Http\Controllers\Auth;

use App\Program;
use App\Rules\PhoneNumber;
use App\Status;
use Faker\Generator as Faker;
use App\User;
use App\Category;
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
            'terms' => 'required',
        ],[
            'terms.required' => __('validation.custom.gdpr'),
            'cv.uploaded' => __('validation.custom.uploaded', ['file' => 'curriculum']),
            'cv.required' => __('validation.custom.required', ['attribute' => 'curriculum'])
        ]);

//        $validator->after(function($validator) {
//
//            if ($validator->errors()->has('email')) {
//                $validator->errors()->add('register.email', $validator->errors()->first('email'));
//            }
//        });

        if ($validator->fails()) {
            redirect('register')
                ->withErrors($validator, 'register');
        }

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
            'id' => DB::table('users')->orderBy('id', 'desc')->first()->id + 1,
            'name' => $data['name'],
            'surnames' => $data['surnames'],
            'email' => $data['email'],
            'phone_number' => [
                'prefix' => $data['prefix'],
                'number' => $data['phone_number']
            ],
            'nationality' => $data['nationality'],
            'program_id' => Program::where('value', $data['program'])->first()->id,
            'type' => 'user',
            'status_id' => Status::where('value', 'unverified')->first()->id,
            'email_verified' => now(),
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
        ]);

        $user->update([
            'program_id' => Program::where('value', $data['program'])->first()->id,
            'categories' => isset($data['categories']) ? $data['categories'] : null,
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

        event(new Registered($user = $this->create($request->all())));

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
        $user->createAsStripeCustomer([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => User::e164NumberFormat($user->phone_number),
        ]);


        $admins = User::admins();
        /*
         * Sends a notification to the admin.
         */
        Notification::send($admins, new NewUserNotification($user));
    }
}
