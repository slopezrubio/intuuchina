<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReceivedMessage;

class MailMessagesController extends Controller
{
    public function send(Request $request) {
        $msg = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|max:355'
        ]);

        Mail::to('recmanvideos@gmail.com')->queue(new ReceivedMessage($msg));
    }
}
