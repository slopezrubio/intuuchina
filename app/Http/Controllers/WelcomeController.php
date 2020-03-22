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

        return view('pages.welcome');
    }
}
