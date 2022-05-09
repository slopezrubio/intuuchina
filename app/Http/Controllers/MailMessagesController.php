<?php

namespace App\Http\Controllers;

use App\Rules\Captcha;
use App\Mail\QueryReceived;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailMessagesController extends Controller
{
    public function contactForm(Request $request) {
        $request->flash();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|alpha',
            'email' => 'required|email',
            'subject' => 'required|string',
//            'message' => 'required|max:355',
            'terms' => 'required',
//            'g-recaptcha-response' => new Captcha(),
            'recaptcha-response' => new Captcha(),
        ], [
            'name.required' => 'I need your name',
            'name.alpha' => __('validation.custom.alpha.contact_form'),
            'subject.required' => __('validation.custom.subject.required'),
//            'gdpr.required' => 'You must agree the General Data Protection Regulation',
            'terms.required' => __('validation.custom.gdpr')
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'contact');
        }

        Mail::to(User::admins()->first())
            ->queue(new QueryReceived($validator->validated()));

        return view('pages.message-confirmation');
    }
}
