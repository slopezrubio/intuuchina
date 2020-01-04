<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Links
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the static links of the
    | application.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Navbar
    |--------------------------------------------------------------------------
    */

    'navbar' => [
        'home' => [
            'text' => 'Home',
            'route' => 'home',
            'method' => 'GET',
        ],
        'internship' => [
            'text' => 'Internship',
            'route' => 'internship',
            'method' => 'GET',
        ],
        'learn chinese' => [
            'text' => 'Learn Chinese',
            'route' => 'learn',
            'method' => 'POST',
        ],
        'university' => [
            'text' => 'University',
            'route' => 'university',
            'options' => function() {
                $options = [];

                foreach (__('content.universities') as $study) {
                    array_push($options, $study['heading']);
                }
                return $options;
            }
        ],
        'whyus' => [
            'route' => 'whyus',
            'text' => 'Why Us',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | WebSite Map
    |--------------------------------------------------------------------------
    */

    'webmap' => [
        'internship' => [
            'job offers' => [
                'text' => 'Job Offers',
                'route' => 'internship',
                'method' => 'GET',
            ],
        ],
        'learn-chinese' => [
            'in-person' => [
                'text' => 'In-Person',
                'route' => 'learn',
                'method' => 'POST'
            ],
            'online' => [
                'text' => 'Online',
                'route' => 'learn',
                'method' => 'POST',
            ]
        ],
        'university' => [
            'mba' => [
                'text' => 'MBA',
                'route' => 'university',
                'method' => 'POST'
            ],
            'mib' => [
                'text' => 'M. Intl. Bsns.',
                'route' => 'university',
                'method' => 'POST'
            ],
            'others' => [
                'text' => 'Others Studies',
                'route' => 'university',
                'method' => 'POST'
            ]
        ],
        'why intuuchina' => [
            'why us' => [
                'text' => 'Why Us',
                'route' => 'whyus',
                'method' => 'GET',
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Media
    |--------------------------------------------------------------------------
    */

    'social' => [
        'facebook' => [
            'text' => 'Facebook',
            'url' => 'https://www.facebook.com/intuuchina',
            'square' => true,
        ],
        'instagram' => [
            'text' => 'Instagram',
            'url' => 'https://www.instagram.com/intuuchina/',
            'square' => false,
        ],
        'linkedin' => [
            'text' => 'Linkedin',
            'url' => 'https://www.linkedin.com/company/intuuchina',
            'square' => false,
        ]
    ],

    'home' => 'Home',
    'master of business administration acronym' => 'MBA',
    'master of international business acronym' => 'M. Intl. Bsns',
    'other studies' => 'Other Studies',
    'job offers' => 'Job Offers',
    'on-line' => 'Online',
    'in-person' => 'In-person',
    'about us' => 'About us',
    'privacy policy' => 'Privacy Policy',
    'terms and conditions' => '<a href="#" data-toggle="modal" data-target="#termsAndConditionsModal">Terms & conditions</a>',
    'general data protection regulation' => '<a href="#" data-toggle="modal" data-target="#GDPRModal">General Data Protection Regulations</a>',
    'facebook' => 'Facebook',
    'instagram' => 'Instagram',
    'linkedin' => 'Linkedin',
    'back to the job offers' => 'Back to the Job Offers',
    'job offers dashboard' => 'Job Offers Dashboard',
    'english locale acronym' => 'EN',
    'spanish locale acronym' => 'ES',
];