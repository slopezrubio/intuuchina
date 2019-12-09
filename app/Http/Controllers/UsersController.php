<?php

namespace App\Http\Controllers;

use App\User;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function confirm(Request $request) {
        $user = Auth::user();
        $updated = $user->updateStatus('confirmed');

        if ($updated) {
            return $this->view('partials/forms/dialog-box-' . State::find($user->status_id)->name);
        }

        return view('partials/forms/dialog-box-confirmed');
    }
}
