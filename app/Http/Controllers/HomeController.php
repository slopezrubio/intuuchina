<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

class HomeController extends Controller
{
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

//        if ($user->getCurrentStatus()->name === 'verified') {
//            return redirect()->action('CheckoutsController@processPayment');
//        }

        return view('pages.user.dashboard');
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
