<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'Invalid username or password. Check your credentials.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'e-mail address' => 'E-Mail Address',
    'remember me' => 'Remember Me',
    'forgot your password?' => 'Forgot Your Password ?',
    'password' => 'Password',
    'cancel' => 'Cancel',
    'done it' => 'Done It!',
    'register' => 'Register',
    'send it again' => 'Send It Again',
    'allowed thumbnail formats' => 'Only .JPG, .BMP and .PNG formats are allowed',
    'allowed cv document formats' => 'Only .PDF, .DOC, .DOCX, and .ODT documents are allowed',
    'back to home' => 'Back to Home',
    'verify your email address' => '<p>Please, <br>Verify your Email Address!</p>',

    /*
    |--------------------------------------------------------------------------
    | Navbar
    |--------------------------------------------------------------------------
    |
    | Contains an array with the applications available locales.
    |
    */
    'logout' => 'Logout',
    'login' => 'Login',
    'change pass' => 'Change Password',
    'dashboard' => 'Dashboard',
    'profile' => 'Profile',
    'application status' => 'Application Status',

    /*
    |--------------------------------------------------------------------------
    | User Verification
    |--------------------------------------------------------------------------
    |
    */
    'before proceeding, please check your email' => "
                                                        <p>
                                                            Before proceeding, please check your inbox and verify your email address with the link we have sent you at :email.
                                                        </p>
                                                        <p>
                                                            If you have been waiting for longer than 10 minutes, press the button below to resend the verification link again or contact us at <a href='mailto:" .config('mail.from.address'). "'>" .config('mail.from.address'). "</a> to report it
                                                        </p>
                                                    ",


];
