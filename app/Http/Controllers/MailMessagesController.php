<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReceivedMessage;
use App\Rules\Captcha;

class MailMessagesController extends Controller
{
    /*
     * Fix: No secret provided (recaptcha) TODO
     */
    public function send(Request $request) {
        $request->flash();
        $msg = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email',
            'subject' => 'required|string',
//            'message' => 'required|max:355',
            'terms' => 'required',
            'g-recaptcha-response' => new Captcha()
        ], [
            'name.required' => 'I need your name',
            'subject.required' => 'The message must be accompanied by a subject',
//            'gdpr.required' => 'You must agree the General Data Protection Regulation',
            'terms.required' => 'You must agree with our terms and conditions and GDPR'
        ]);

        Mail::to('recmanvideos@gmail.com')->queue(new ReceivedMessage($msg));

        return view('pages.message-confirmation');
    }
}
