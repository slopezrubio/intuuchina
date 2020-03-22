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
            'url' => url('why'),
            'text' => 'Why Us',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | User Verification
    |--------------------------------------------------------------------------
    */
    'user-verification' => [
        'home' => [
            'text' => "Go Back",
            'url' => url('/')
        ],
        'whyus' => [
            'text' => 'Why IntuuChina',
            'url' => url('why'),
        ],
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