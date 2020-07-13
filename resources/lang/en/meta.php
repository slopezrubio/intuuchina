<?php

return [
    'title' => [
        'index' =>  config('app.name', 'IntuuChina') . ' • Going Beyond Together',
        'internship' => 'Internship Job Board' . ' • ' . config('app.name', 'IntuuChina'),
        'user_verification' => 'User Verification',
        'learn-chinese' => 'Learn Chinese' . ' • ' . config('app.name', 'IntuuChina'),
        'why-intuuchina' => 'Why Us' . ' • ' . config('app.name', 'IntuuChina'),
        'offers' => [
            'paginator' => 'Internship Job Board (Page :current of :last)',
            'default' => 'Internship Job Board' . ' • ' . config('app.name', 'IntuuChina'),
        ],
        'job-description' => ':job' . ' • ' . config('app.name', 'IntuuChina'),
        'university' => 'University' . ' • ' . config('app.name', 'IntuuChina'),
        'login' => 'Sign In' . ' • ' . config('app.name', 'IntuuChina'),
        'register' => 'Sign Up' . ' • ' . config('app.name', 'IntuuChina'),
        'passwords' => [
            'email' => 'Reset Password' . ' • ' . config('app.name', 'IntuuChina')
        ]
    ],
    'description' => [

    ],
    'canonical' => [
        'home' => config('app.url'),
    ],
];
