<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    //

    public function index() {
        $user = Auth::user();

        $user->update([
           'status_id' => Status::where('value', 'verified')->first()->id,
        ]);

        return view('pages.welcome');
    }
}
