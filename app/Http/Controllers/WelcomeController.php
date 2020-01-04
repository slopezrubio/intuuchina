<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    //

    public function index() {
        $user = Auth::user();

        $user->updateStatus('verified');

        if (session()->get('program')) {
            return view('pages.welcome', ['payment' => true]);
        }

        return view('pages.welcome');
    }
}
