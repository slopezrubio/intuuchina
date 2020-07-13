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
        ],
        'user' => [
            'status' => 'Application Status',
            'profile' => 'User Profile',
            'billings' => 'Your Billings',
            'home' => 'Dashboard'
        ],
        'admin' => [
            'users' => 'Users • Dashboard',
            'offers' => 'Job Offers • Dashboard',
            'testimonials' => 'Testimonials • Dashboard',
            'fees' => 'Fees • Dashboard',
            'default' => 'Dashboard',
        ],
    ],
    'description' => [
        'internship' => 'Looking for an internship in China? Check out the alternatives by sector and city. From Shanghai to Shenzhen, from Beijing to Honk Kong. We will help you find the right company to intern in but also help you with the visa, apartment search, etc.',
        'learn' => 'We are in touch with some of the best language schools in Honk Kong, Shanghai and Beijing and all over China! Learn Chinese with us and let us help you with Visa and other administrative procedures.',
        'university' => 'China has great Universities. Looking to study your bachelor/undergrad in China? Maybe your Master Degree in China? We can help and will guarantee your entry!',
        'register' => 'Keep up to date with our latest news!',
        'login' => 'Check the stage your application is in.',
        'offers' => [
            'paginator' => 'Page :current • Looking for an internship in China? Check out the alternatives by sector and city. From Shanghai to Shenzhen, from Beijing to Honk Kong. We will help you find the right company to intern in but also help you with the visa, apartment search, etc.',
            'default' => 'Looking for an internship in China? Check out the alternatives by sector and city. From Shanghai to Shenzhen, from Beijing to Honk Kong. We will help you find the right company to intern in but also help you with the visa, apartment search, etc.',
        ],
        'passwords' => [
            'email' => 'Want to study in China or do an Internship in China but ¿Cant find your password? Let us help!',
        ],
        'why-intuuchihna' => 'Learn a bit about us: Our awards, history, our values, our team and our community in China.',
    ],
    'canonical' => [
        'home' => config('app.url'),
    ],
];
