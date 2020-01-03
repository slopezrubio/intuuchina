<?php

namespace App\Http\Controllers;

use App\User;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function confirm(Request $request) {

        // Gets the authenticated user and updates his status.
        $user = User::find(Auth::id());
        $user = $user->updateStatus('verified');

        $currentStatus = State::find($user->status_id)->name;

        return view('partials/forms/dialog-box-' . $currentStatus);
    }

    public function single($id) {

    }
}
