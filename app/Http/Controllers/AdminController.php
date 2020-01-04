<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Displays a list of all the users with readable information.
     */
    public function users() {
        $users = User::adminReadableList();

        return view('pages/admin/users', compact('users'));
    }
}
