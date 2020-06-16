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
