<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Breadcrumbs
    |--------------------------------------------------------------------------
    */
    'breadcrumbs' => [
        'admin' => [
            'upgrade' => [
                [
                    'href' => route('admin'),
                    'content' => trans('Dashboard'),
                ],
                [
                    'href' => route('admin.users'),
                    'content' => trans('Users'),
                ]
            ],
            'users' => [
                [
                    'href' => route('admin'),
                    'content' => trans('Dashboard'),
                ],
            ],
            'user' => [
                [
                    'href' => route('admin'),
                    'content' => trans('Dashboard'),
                ],
                [
                    'href' => route('admin.users'),
                    'content' => trans('Users'),
                ]
            ],
            'fee' => [
                [
                    'href' => route('admin'),
                    'content' => trans('Dashboard'),
                ],
                [
                    'href' => route('admin.fees'),
                    'content' => trans('Fees'),
                ]
            ],
            'offer' => [
                [
                    'href' => route('admin'),
                    'content' => trans('Dashboard'),
                ],
                [
                    'href' => route('admin.offers'),
                    'content' => trans('Offers'),
                ]
            ],
            'new-offer' => [
                [
                    'href' => route('admin'),
                    'content' => trans('Dashboard'),
                ],
                [
                    'href' => route('admin.offers'),
                    'content' => trans('Offers'),
                ]
            ],
            'new-fee' => [
                [
                    'href' => route('admin'),
                    'content' => trans('Dashboard'),
                ],
                [
                    'href' => route('admin.fees'),
                    'content' => trans('Fees'),
                ]
            ]
        ],
        'job-description' => [
            [
                'href' => route('internship'),
                'content' => trans('Internship'),
            ]
        ]
    ],


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
            'mib' => [
                'heading' => 'M. Intl. Bsns.',
                'description' => 'The Master in International Business is on of the best ways for students to grasp aspects of managing an international company in various fields such as Marketing, Sales, Operations, Supply Chain, Accounting, Strategy, Human resources, etc. It is a unique opportunity to be exposed to the top of the line academic and real-life material to improve your skills as a future International Business Leader with a strong Chinese edge.',
            ],
            'mba' => [
                'heading' => 'MBA',
                'description' => 'The MBA is aimed at experienced professionals, middle management or people that want to give that next step in their career to management in a company. The program has a comprehensive and integrated understanding of techniques of management and executive skills that are key in the future business leaders.',
            ],
            'other_degrees' => [
                'heading' => 'Other',
                'description' => 'Looking for to study something different? Let us know and we will try our best to help you!',
            ],
        ],
        'study' => [
            'in-person' => [
                'heading' => ':header',
                'description' => 'With our experienced teachers you will find yourself learning Mandarin Chinese much faster than you thought possible. We have classes for all levels and for all types of learners. Want to study in a group class? With a private tutor? At your office? We have the perfect program for you! At IntuuChina, classes always center around you and your teaching needs. We adjust the level of the class to fit your current skills as well as your ambitions. Let us know what your goal is, and our teachers will help you reach it.',
            ],
            'online' => [
                'heading' => ':header',
                'description' => 'Looking for convenience? We can help you through our video conferencing tools. With our experienced teachers you will find yourself learning Mandarin Chinese much faster than you thought possible.', 'At IntuuChina classes always center around you and your teaching needs. We adjust the level of the class to fit your current skills as well as your ambitions. Let us know what your goal is, and our teachers will help you reach it.',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Price Boxes
    |--------------------------------------------------------------------------
    */
    'c-price-box' => [
        'in-person' => [
            'label' => trans('From'),
            'currencies' => [
                'eur' => trans('currencies.eur.symbol') . ' / ' . trans('currencies.eur.code'),
                'usd' => trans('currencies.usd.symbol') . ' / ' . trans('currencies.usd.code'),
            ],
            'footer' => "
                            <h3>
                                " . trans('Please Note') . "
                            </h3>
                           <p>
                                " . trans('content.the price above') . " 
                            </p>
                        "
        ],
        'online' => [
            'label' => trans('Hourly Price'),
            'currencies' => [
                'eur' => trans('currencies.eur.symbol') . ' / h',
                'usd' => trans('currencies.usd.symbol') . ' / h',
            ],
            'footer' => "
                            <h3>
                                " . trans('Please Note') . "
                            </h3>
                            <p>
                                " . trans('content.a minimum number') . "
                            </p>
                        "
        ]
    ],

    /*
   |--------------------------------------------------------------------------
   | Infography
   |--------------------------------------------------------------------------
   */
    'infographies' => [
        'customer-journey' => [
            [
                'title' => trans('Apply / Register'),
                'icon' => trans('pictures.user-icon'),
                'href' => route('register'),
            ],
            [
                'title' => trans('Select a program'),
                'icon' => trans('pictures.user-icon'),
                'href' => '#services',
            ],
            [
                'title' => trans('Get the Best Counseling'),
                'icon' => trans('pictures.papers-icon')
            ],
            [
                'title' => trans('We Get to Work'),
                'icon' => trans('pictures.user-icon')
            ],
            [
                'title' => trans('Start in China!'),
                'icon' => trans('pictures.rocket-icon')
            ],
        ],
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
            'background' => trans('pictures.internship.url'),
        ],
        'university' => [
            'title' => 'University',
            'description' => 'We have worked with all major business schools in China placing 100% of our applicants. Let us help you!',
            'href' => url('/university'),
            'background' => trans('pictures.university.url')
        ],
        'learn_chinese' => [
            'title' => 'Learn Chinese',
            'description' => 'Study the most spoken first language in the world. Come to China for a full immersion or join classes on-line',
            'href' => url('/learn'),
            'background' => trans('pictures.study.url')
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Square Grids
    |--------------------------------------------------------------------------
    */
    'square-grids' => [
        'motifs' => [
            [
                'id' => 'awards_honours',
                'title' => trans('Awards & Honours'),
                'background-image' => asset('storage/images/content/awards_honours_background.jpeg'),
                'content' =>    "
                                    <ul>
                                        <li>
                                            <p>
                                            International Startup RTVE Award
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Second Prize for best Startup of the year by the Spanish Chamber of Commerce
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Comprendedor Award finalist, &#34;Empresa & Sociedad&#34; foundation
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Second prize for best Human Resource IEBS Startup
                                            </p>
                                        </li>
                                    </ul>
                                ",
                'picture' => trans('pictures.awards and honours'),
                'color' => 'black',
            ],
            [
                'id' => 'mission_vision',
                'title' => trans('Mission & Vision'),
                'content' =>    "
                                <p>
                                    IntuuChina's first priority is to help people and organizations make a successful transition in China. To this end, we will guide you on your own path by making available the most valuable resources. An energetic and experienced team.
                                </p>
                                ",
                'color' => 'white',
            ],
            [
                'id' => 'what_makes_us_different',
                'title' => trans('What Makes Us Different'),
                'background-image' => asset('storage/images/content/what_makes_us_different_background.png'),
                'content' =>    "
                                <p>
                                   This team is committed and dedicated to provide a set of personalized services that will add real value and a competitive advantage to the future professional career.
                                </p>
                                ",
                'picture' => trans('pictures.what makes us different'),
                'color' => 'gray',
            ],
            [
                'id' => 'values',
                'title' => trans('Values'),
                'content' =>    "
                                <p>
                                    The IntuuChina team has chosen the values it wants to represent, and is strongly committed to the following values: effort, commitment, ambition, perseverance, uniqueness, optimism, open mind and proactivity.
                                </p>
                                ",
                'color' => 'red',
            ],
            [
                'id' => 'what_we_offer',
                'title' => trans('What We Offer'),
                'background-image' => asset('storage/images/content/what_we_offer_background.png'),
                'content' =>    "
                                <p>
                                   We offer tailor-made internship and study programs in China to university students, recent graduates and young professionals. 
                                   We are also acting as a consulting and head-hinting firm for those organizations looking to expand their business or outsource
                                   their recruitment process in China.
                                </p>
                            ",
                'picture' => trans('pictures.what we offer'),
                'color' => 'black',
            ],
            [
                'id' => 'meet_intuuchina',
                'title' => trans('Meet IntuuChina'),
                'content' =>    "
                                <p>
                                   Global minded people who believe in the effort, team-work and the will as the most valuable way to achieve one's own goals make up 
                                   IntuuChina community, a community that thrives to connect international professionals to China and create links between people from all cultures.
                                </p>
                            ",
                'color' => 'white',
            ],
        ]
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
                'billings' => [
                    'text' => trans('Billings'),
                    'icon' => 'fas fa-money-bill-alt',
                    'content' => 'partials.user._billings',
                ]
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
    'curiosity-cards' => [
        '404' => [
            [
                'front' => 'The mountain of the right is one of the sacred mountains of Taoism and it raises up 2160m. ',
                'back' => 'Mount Hua',
            ],
            [
                'front' => 'The dish of the left is originated in the region of Shanxi and it is considered a medicinal soup.',
                'back' => 'Tounaou Soup',
            ],
            [
                'front' => 'The place where this pillars are located took a big part in one of James Cameron\'s film',
                'back' => 'Zhangjiajie National Forest Park',
            ],
        ]
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
                'heading' => trans('Learn Chinese'),
                'options' => function() {
                    $options = [];
                    foreach (App\Program::where('value', 'study')->first()->studies as $study) {
                        $option = array(
                            'method' => 'GET',
                            'text' => $study->name,
                            'url' => url('learn?param=' . $study->value)
                        );
                        $options[$study->value] = $option;
                    }
                    return $options;
                }
            ],
            'university' => [
                'heading' => 'University',
                'options' => function() {
                    $options = [];
                    foreach (App\Program::where('value', 'university')->first()->degrees as $degree) {
                        $option = array(
                            'method' => 'GET',
                            'text' => $degree->name,
                            'url' => url('university?param=' . $degree->value)
                        );
                        $options[$degree->value] = $option;
                    }
                    return $options;
                }
            ],
            'why intuuchina' => [
                'heading' => trans('Why Us'),
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
                'title' => trans('Dashboard'),
            ],
            'users' => [
                'title' => trans('Users'),
            ],
            'new-offer' => [
                'title' => trans('New Job Offer')
            ],
            'new-fee' => [
                'title' => trans('New Product Fee')
            ],
        ],
        'home' => [
            'title' => 'Internships in a Startup <br>or</br> Study Chinese or an MBA',
            'background' => asset('storage/images/headers/home.jpg'),
        ],
        'learn-chinese' => [
            'title' => trans('Learn Chinese'),
            'background' => asset('storage/images/headers/learn_chinese.jpg'),
        ],
        'offers' => [
            'title' => trans('Job Board'),
            'background' => asset('storage/images/headers/internship.jpg'),
        ],
        'job-description' => [
            'title' => ':title',
            'background' => ':background'
        ],
        'register' => [
            'title' => trans('Sign Up'),
        ],
        'university' => [
            'title' => 'University',
            'background' => asset('storage/images/headers/university.jpg'),
        ],
        'user' => [
            'dashboard' => [
                'title' => trans('Dashboard')
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
        'why-intuuchina' => [
            'background' => asset('storage/images/why-us_header.jpg'),
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
        'password' => [
            'email' => [
                'title' => trans('Reset Password'),
            ],
            'reset' => [
                'title' => trans('Password Confirmation'),
            ],
            'change' => [
                'title' => trans('Change Password'),
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
                foreach (App\Program::where('value', 'study')->first()->studies as $study) {
                    $option = array(
                        'text' => $study->name,
                        'url' => url('learn?param=' . $study->value)
                    );

                    $options[$study->value] = $option;
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
                foreach (App\Program::where('value', 'university')->first()->degrees as $degree) {
                    $option = array(
                        'text' => $degree->name,
                        'url' => url('university?param=' . $degree->value)
                    );

                    $options[$degree->value] = $option;
                }
                return $options;
            }
        ],
        'whyus' => [
            'url' => url('why'),
            'text' => 'Why Us',
        ],
    ],
];
