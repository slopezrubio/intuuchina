<?php

return [
    'visitor-query' => [
        'subject' => trans('Your query has been received'),
        'title' => 'Query received to IntuuChina',
        'body' =>   "
                    <p>
                        We confirm you that we have received your request. As soon as possible we will attend to it to provide the best response for it.
                    </p>
                    "
    ],
    'reset-password' => [
        'subject' => trans('Reset Password Notification'),
        'title' => 'Reset Password Link',
        'body' =>   [
            'greeting' =>   "
                            <p>
                                Hi :name,
                            </p>
                            <p>
                                You have received this email because you request a password reset link. 
                            </p>    
                            ",
            'message' =>    "
                            <p>
                                This password reset link will expire in 60 minutes.
                            </p>
                            ",
            'farewell' =>   "
                            <p>
                                If you should not have received it, please report it at <a href='mailto:".config('mail.to.address')."'>".config('mail.from.address')."</a>
                            </p>
                            <p>
                                Regards, <br/>" . config('app.name') . "
                            </p>
                            "
        ],
    ],

];