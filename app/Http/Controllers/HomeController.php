<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

class HomeController extends Controller
{

    const USER_ELEMENTS_PER_PAGE = 9;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application welcome dialog or the user home.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->type === 'admin') {
            return redirect('/admin');
        }

        if ($user->stripe_id !== null) {
            $user->asStripeCustomer();
            $invoices = new LengthAwarePaginator($user->invoices()->toArray(), count($user->invoices()->toArray()),  self::USER_ELEMENTS_PER_PAGE, 1, [
                'path' => route('user.billings'),
            ]);

            return view('pages.user.dashboard', ['data' => [
                'billings' => $invoices
            ]]);
        }

        return view('pages.user.dashboard');
    }

    public function profile() {
        return view('pages.user.dashboard', [
            'selected' => 'profile',
        ]);
    }

    public function status() {
        return view('pages.user.dashboard', [
            'selected' => 'status',
        ]);
    }

    public function billings() {
        return view('pages.user.dashboard', [
            'selected' => 'billings',
        ]);
    }

    /**
     * Show the application dashboard for administrators.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {
        return view('pages.admin.dashboard');
    }
}
