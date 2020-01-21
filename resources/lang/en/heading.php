<?php

return [
    'admin' => [
        'dashboard' => [
            'title' => 'Dashboard'
        ],
        'users' => [
            'title' => 'Users',
        ],
    ],
    'home' => [
        'title' => 'Internships in a Startup <br>or</br> Study Chinese or an MBA',
        'background' => asset('storage/images/shanghai_internship_skyline.jpg'),
    ],
    'learn-chinese' => [
        'title' => 'Learn Chinese',
        'background' => asset('storage/images/learn1.jpg'),
    ],
    'offers' => [
        'title' => 'Job Board',
        'background' => asset('storage/images/practicass.jpg'),
    ],
    'register' => [
        'title' => 'Sign Up',
    ],
    'university' => [
        'title' => 'University',
        'background' => asset('storage/images/headers/university.jpg'),
    ],
    'why-us' => [
        'background' => asset('images/why-us_header.jpg'),
        'stats' => [
            "
                <p>More than</p>
                <div class='stats__item-background'><h4 class='stats__item-counter'>400</h4></div>
                <p>People in China</p>
            ",
            "
                <p>More than</p>
                <div class='stats__item-background'><h4 class='stats__item-counter'>500</h4></div>
                <p>Monthly applications</p>
            ",
            "
                <p>From</p>
                <div class='stats__item-background'><h4 class='stats__item-counter'>41</h4></div>
                <p>Countries</p>
            ",
        ]
    ],
];