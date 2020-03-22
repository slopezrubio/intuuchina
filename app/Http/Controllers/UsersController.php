<?php

namespace App\Http\Controllers;

use App\User;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function confirm(Request $request) {

        // Gets the authenticated user and updates his status.
        $user = User::find(Auth::id());
        $user = $user->updateStatus('verified');

        $currentStatus = State::find($user->status_id)->name;

        return view('partials/forms/dialog-box-' . $currentStatus);
    }

    public function changeProgram(string $program) {

    }

    public function single($id) {

    }

    public function destroy($id) {
        $user = User::find($id);

        $user->destroyAssociatedFiles();

        User::destroy($user->id);

        return redirect()->route('admin.users');
    }
}
