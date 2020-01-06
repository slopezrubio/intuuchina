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
            'url' => url('/'),
            'method' => 'GET',
        ],
        'internship' => [
            'text' => 'Internship',
            'url' => url('internship'),
            'method' => 'GET',
        ],
        'learn-chinese' => [
            'text' => 'Learn Chinese',
            'url' => url('/learn'),
            'method' => 'POST',
            'options' => function() {
                $options = [];
                foreach (__('content.courses') as $key => $value) {
                    $option = array(
                        'text' => $value['text'],
                        'url' => url('learn?param=' . $key)
                    );
                    $options[$key] = $option;
                }
                return $options;
            }
        ],
        'university' => [
            'text' => 'University',
            'url' => '/university',
            'method' => 'POST',
            'options' => function() {
                $options = [];
                foreach (__('content.universities') as $key => $value) {
                    $option = array(
                        'text' => $value['heading'],
                        'url' => url('university?param=' . $key)
                    );
                    $options[$key] = $option;
                }
                return $options;
            }
        ],
        'whyus' => [
            'url' => '/whyus',
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
            'heading' => 'Internship',
            'options' => function() {
                return array(
                    'job offers' => [
                        'text' => 'Job Offers',
                        'url' => url('whyus'),
                        'method' => 'GET',
                    ]
                );
            }
        ],
        'learn-chinese' => [
            'heading' => 'Learn Chinese',
            'options' => function() {
                $options = [];
                foreach (__('content.courses') as $key => $value) {
                    $option = array(
                        'method' => 'GET',
                        'text' => $value['text'],
                        'url' => url('learn?param=' . $key)
                    );
                    $options[$key] = $option;
                }
                return $options;
            }
        ],
        'university' => [
            'heading' => 'University',
            'options' => function() {
                $options = [];
                foreach (__('content.universities') as $key => $value) {
                    $option = array(
                        'method' => 'GET',
                        'text' => $value['heading'],
                        'url' => url('university?param=' . $key)
                    );
                    $options[$key] = $option;
                }
                return $options;
            }
        ],
        'why intuuchina' => [
            'heading' => 'Why Us',
            'options' => function() {
                return array(
                    'why us' => [
                        'text' => 'Why Us',
                        'url' => 'whyus',
                        'method' => 'GET',
                    ]
                );
            }
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