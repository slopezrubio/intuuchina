<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sliders
    |--------------------------------------------------------------------------
    */
    'media' => [
        'el_pais' => [
            'href' => 'https://elpais.com/economia/2016/05/05/actualidad/1462462986_888570.html',
            'quote' => 'The statistics confirmed that IntuuChina hit the spot: They have managed to place 290 people of 46 nationalities ... The highest percentage of success (78%) is among those who arrived in China with the intention of staying',
            'author' => 'Z. Aldama',
            'date' => '08/05/2016',
        ],
        'eitb' => [
            'href' => 'https://www.youtube.com/watch?v=8dsj6xTclco',
            'quote' => 'Chinese companies are hiring foreign talent to help them internationalize',
            'date' => '05/04/2015',
        ],
        'el_mundo' => [
            'href' => 'https://www.elmundo.es/cronica/2014/10/26/544b4edee2704e68668b456e.html',
            'quote' => 'In just 9 months, an IntuuChina candidate went from being a fellow in a sales department to running that department',
            'date' => '26/10/2014',
        ],
        'atresmedia' => [
            'href' => 'https://www.youtube.com/watch?v=oFpAvIT0vjg',
            'quote' => 'They started helping their friends to disembark in the Asian market and ended up making it a successful career',
            'author' => 'S. Romero',
            'date' => '02/05/2014'
        ],
        'fortune' => [
            'href' => 'https://fortune.com/2015/12/01/spain-job-market/',
            'quote' => 'In just 4 months since I arrived in China I found a job as an account manager ... I think it was the best decision I\'ve made',
            'author' => 'I. Mount',
            'date' => '01/12/2015'
        ],
        'ccma' => [
            'href' => 'http://www.ccma.cat/tv3/alacarta/telenoticies-cap-de-setmana/buscar-feina-a-la-xina/video/5540176/',
            'quote' => 'I prefer to work outside, is better paid, it is easier to find an opportunity with IntuuChina and it is a fantastic experience',
            'date' => '19/07/2015',
        ],
        'rtve' => [
            'href' => 'http://www.rtve.es/rtve/20161123/ii-premios-rtve-emprende-reconocen-intuuchina-clicars-sociograph-languing-walden-medical/1446483.shtml',
            'quote' => 'The Internationalization Award, presented by the director of Casa de América, Santiago Miralles, has been for IntuuChina, who advises young people from various countries on how they can access the Chinese labor market',
            'date' => '23/11/2016'
        ],
        'abc' => [
            'href' => 'https://www.bambooventures.org/foto',
            'quote' => 'The Internationalization Award, presented by the director of Casa de América, Santiago Miralles, has been for IntuuChina, who advises young people from various countries on how they can access the Chinese labor market',
            'author' => 'Pablo M. Díez',
            'date' => '09/11/2014',
        ],
        'entrepeneur' => [
            'href' => 'https://www.emprendedores.es/ideas-de-negocio/a49898/intuuchina/',
            'quote' => 'We help talented young people who do not find opportunities in their country, as would be the case in Spain, and we help them develop their career in China',
            'date' => '21/05/2015',
        ]
    ],
    'arrow' => [
        'university' => [
            'mba' => [
                'heading' => 'MBA',
                'description' => 'The Master in International Business is on of the best ways for students to grasp aspects of managing an international company in various fields such as Marketing, Sales, Operations, Supply Chain, Accounting, Strategy, Human resources, etc. It is a unique opportunity to be exposed to the top of the line academic and real-life material to improve your skills as a future International Business Leader with a strong Chinese edge.',
                'key' => 'mba',
                'text' => 'MBA',
            ],
            'mib' => [
                'heading' => 'M. Intl. Bsns.',
                'description' => 'The MBA is aimed at experienced professionals, middle management or people that want to give that next step in their career to management in a company. The program has a comprehensive and integrated understanding of techniques of management and executive skills that are key in the future business leaders.',
                'key' => 'mib',
                'text' => 'M. Intl. Bsns.',
            ],
            'other' => [
                'heading' => 'Other',
                'description' => 'Not Provided',
                'key' => 'other',
                'text' => 'Other',
            ],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Info Boxes
    |--------------------------------------------------------------------------
    */
    'services' => [
        'internship' => [
            'title' => 'Internship',
            'description' => 'Looking for a professional experience in China? We can place you in Startup or Multinational.',
            'href' => url('/internship'),
            'background' => asset('storage/images/practicass.jpg'),
        ],
        'university' => [
            'title' => 'University',
            'description' => 'We have worked with all major business schools in China placing 100% of our applicants. Let us help you!',
            'href' => url('/university'),
            'background' => asset('storage/images/student.jpg')
        ],
        'learn_chinese' => [
            'title' => 'Learn Chinese',
            'description' => 'Study the most spoken first language in the world. Come to China for a full immersion or join classes on-line',
            'href' => url('/learn'),
            'background' => asset('storage/images/service-1.jpg')
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tabs
    |--------------------------------------------------------------------------
    */
    'tabs' => [
        'dashboard' => [
            'user' => [
                'status' => [
                    'text' => trans('Status'),
                    'icon' => '',
                    'content' => 'partials.user._status',
                ],
                'profile' => [
                    'text' => trans('Profile'),
                    'icon' =>  'fas fa-user',
                    'content' => 'partials.forms.user._profile'
                ],
            ],
            'admin' => [
                'users' => [
                    'text' => trans('Users'),
                    'icon' => 'fas fa-user',
                    'content' => 'partials.admin._users'
                ],
                'offers' => [
                    'text' => trans('Offers'),
                    'icon' => 'fas fa-user-md',
                    'content' => 'partials.admin._offers'
                ],
                'testimonials' => [
                    'text' => trans('Testimonials'),
                    'icon' => 'fas fa-eye',
                    'content' => 'partials.admin._testimonials'
                ],
                'fees' => [
                    'text' => trans('Fees'),
                    'icon' => 'fas fa-money-bill-alt',
                    'content' => 'partials.admin._fees'
                ]
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Cards
    |--------------------------------------------------------------------------
    */
    'media-cards' => [
        'offers' => [
            'not found' => trans('content.no such item has been found', ['item' => 'offers'])
        ],
        'users' => [
            'not found' => trans('content.no such item has been found', ['item' => 'users'])
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Website Map
    |--------------------------------------------------------------------------
    */
    'webmap' => [
        'footer' => [
            'internship' => [
                'heading' => 'Internship',
                'options' => function() {
                    return array(
                        'job offers' => [
                            'text' => 'Job Offers',
                            'url' => url('internship'),
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
                            'url' => url('why'),
                            'method' => 'GET',
                        ]
                    );
                }
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Media
    |--------------------------------------------------------------------------
    */
    'social' => [
        'facebook' => [
            'text' => trans('Facebook'),
            'url' => 'https://www.facebook.com/intuuchina',
            'square' => true,
        ],
        'instagram' => [
            'text' => trans('Instagram'),
            'url' => 'https://www.instagram.com/intuuchina/',
            'square' => false,
        ],
        'linkedin' => [
            'text' => trans('LinkedIn'),
            'url' => 'https://www.linkedin.com/company/intuuchina',
            'square' => false,
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Headers
    |--------------------------------------------------------------------------
    */
    'header' => [
        'admin' => [
            'dashboard' => [
                'title' => trans('content.dashboard'),
            ],
            'users' => [
                'title' => 'Users',
            ],
            'new-offer' => [
                'title' => 'New Job Offer'
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
        'job-description' => [
            'title' => ':title',
            'background' => ':background'
        ],
        'register' => [
            'title' => 'Sign Up',
        ],
        'university' => [
            'title' => 'University',
            'background' => asset('storage/images/headers/university.jpg'),
        ],
        'user' => [
            'dashboard' => [
                'title' => trans('content.dashboard')
            ],
            'welcome' => [
                'background' => asset('storage/images/headers/welcome.jpg')
            ],
            'payment' => [
                'title' => trans('Payment'),
            ],
            'payment-confirmation' => [
                'title' => trans('Payment Completed'),
            ]
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
    ],
    'dialog' => [
        'user' => [
            'verified' =>   "
                            <p>
                                The verification process is done. We just want to thank you for applying and your trust in our services.
                                <p>As soon as we receive the corresponding payment for your :program Program we will contact you to arrange our first meeting.</p>
                            </p>
                            <p>
                                Proceed with the payment?
                            </p>
                            ",
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Navs
    |--------------------------------------------------------------------------
    */
    'navs' => [
        'bottom' => [
            'job-description' => [
                'items' => [
                    'content' => trans('Home'),
                    'icon' => 'fas fa-home',
                ]
            ]
        ]
    ]
];
