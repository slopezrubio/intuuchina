<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Content Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the static content of the
    | application.
    |
    */
    'no such item has been found' => 'No :item has been found',
    'are you sure you want to remove' => 'Are you sure you want to remove this :item?',

    /*
    |--------------------------------------------------------------------------
    | Titles
    |--------------------------------------------------------------------------
    */

    'what the media think' => 'What <strong>the media</strong> think about IntuuChina',
    'those who have already tried it says' => 'Those who have already tried it says',
    'internship' => 'Internship',
    'dashboard' => 'Dashboard',
    'learn chinese' => 'Learn Chinese',
    'why intuuchina' => 'Why IntuuChina',
    'job offers' => 'Job Offers',
    'job description' => 'Job Description',
    'new offer' => 'New Offer',
    'values' => 'Values',
    'know us' => 'Know Us',
    'delete job offer modal' => 'Delete Job Offer',
    'those who have already tried it' => 'Those <strong>who have already tried it</strong>',
    'description' => 'Description',
    'details' => 'Details',
    'user' => 'User',
    'user since' => 'User since',



    /*
    |--------------------------------------------------------------------------
    | Text
    |--------------------------------------------------------------------------
    */

    'attached' => 'Attached',
    'business card' =>  "
                        <li>
                            Phone Number: (+86) 21 61 84 85 57
                        </li>
                        <li>
                            Email: " . config('mail.from.address') . "
                        </li>
                        <li>
                            IntuuChina Team
                        </li>
                        ",
    'follow us' => 'Follow Us',
    'the price above' => 'The price above corresponds to the minimum staying of one month. Visa fees are included.',
    'a minimum number' => 'A minimum number of 40 hours in order to apply for this course.',
    'we need you to pay' => 'We need you to pay in order to proceed with the process',
    'not provided' => 'Not Provided',
    'about your program' => 'About your :program program',
    'resume' => 'Resume',
    'website map' => 'WebSite Map',
    'contact us' => 'Contact Us!',
    'done user' =>  [
        'online' => "
                        <p>
                            The process is done. We hope you enjoy your Mandarin Chinese online classes. 
                        </p>
                        <p>
                            In the event that you have any doubts or issues you would like to deal with we remind you have available <a href='mailto:".config('mail.to.address')."'>".config('mail.from.address')."</a> to let us know them.
                        </p>
                    ",
        'default' =>    "
                            <p>
                                The path is ready to be gone through, we hope all the best for you during your :program Program. We will keep advising you along your way in China.
                            </p>
                        ",
    ],
    'placed user' =>    [
        'online' =>     "
                            <p>
                                
                            </p>
                        ",
        'default' =>    "
                            <p>
                                You have already been placed in the location wherein you are going to carry out you :program Program. 
                                Check your inbox for more details about it.
                            </p>
                            <p>
                                Don't forget to let us know whatever issue or doubt you want to deal with at <a href='mailto:".config('mail.to.address')."'>".config('mail.from.address')."</a>
                            </p>
                        ",
    ],
    'dismissed user' =>  "
                            <p>
                                Unfortunately, we have decided not to keep with you application, since we cannot warranty the success thereof. Thus, we have proceed to the dismissal of your application. 
                                In the next few days you will be reimbursed integrally with the same amount as the application has been invested so far.
                            </p>
                            <p>
                                Check your inbox to see more details about it.
                            </p>
                            <p>
                                Don't forget to let us know whatever issue or doubt you want to deal with at <a href='mailto:".config('mail.to.address')."'>".config('mail.from.address')."</a>
                            </p>
                        ",
    'accepted user' =>  "
                            <p>
                                Your application for the :program Program has been accepted. We have sent you and email with more details.
                            </p>
                            <p>
                                Don't forget to let us know whatever issue or doubt you want to deal with at <a href='mailto:".config('mail.to.address')."'>".config('mail.from.address')."</a>
                            </p>
                        ",
    'interviewed user' =>   "
                              <p>
                                  After our first interview, the next step for us will be to scrutinize the chances that best fits the success of your application. Notice that, even though we have placed the 90% of the candidates we dealt, it is still possible, albeit unlikely, to dismiss
                                  your application if we consider imperiled the success thereof.
                              </p>
                              <p>
                                  If you have any doubts about the process, please don't hesitate to contact us at <a href='mailto:".config('mail.to.address')."'>".config('mail.from.address')."</a>. We are to keep improving our services.
                              </p>  
                            ",
    'paid user' =>  "{1}
                        <p>
                            The payment has been carried out successfully. You should have received an email with the corresponding billing.
                        </p>
                        <p>
                            In the next few hours we are going to get you in touch to arrange our first meeting with you, so we recommend you to check assiduously your inbox. Before this to happen, <b>let us know whether if you
                            would be available or not to do an in-person meeting with us</b> by reporting it at <a href='mailto:".config('mail.to.address')."'>".config('mail.from.address')."</a>
                        </p>
                        <p>
                            Do you want to see the billing?
                        </p>
                        |{0}
                        <p>
                            You should have an email with the corresponding billing attached. 
                        </p>
                        <p>
                            In the next few hours we are going to get you in touch to arrange our first meeting with you, so we recommend you to check assiduously your inbox.
                        </p>
                        <p>
                           However, if none of those emails have been reached out your inbox in the next few days, please report it at <a href='mailto:".config('mail.to.address')."'>".config('mail.from.address')."</a>.
                           Use the given email to let us know whether if <b>you would be available to do an in-person meeting with us ASAP.</b>                                          
                        </p>
                        
                    ",
    'verified user' =>   "
                        <p>
                            You have been successfully registered. Nonetheless we remind you that in order to proceed with your application
                            it is necessary to carry out the corresponding payment for your :program Program.
                        </p>
                    ",
    'gdpr' =>   "
                    <p>
                        First of all we thank you for the interest you have shown in addressing IntuuChina Ltd. by providing us with your data and information.</p>' . '<p>We inform you that, in accordance with the data protection regulations, your data will be subject to treatment by IntuuChina Ltd. as Responsible for it with the purpose of managing your resume for the selection of personnel. If your profile is not conform to the relevant requirements in the current selection processes we will proceed to keep your data for future processes that do fit your profile, unless you. Tell us otherwise. We have your consent for the processing of the data you have provided us with voluntary, free and informed form in order to participate in the selection processes of the organization.
                    </p>
                    <p>
                        On the other hand, we want to inform you that we will not transfer your data to third parties, unless express authorization or legal obligation. Nor are international transfers to other countries planned. You may exercise your rights of access, rectification, deletion, opposition, limitation of processing, portability, transparency in information and no longer be subject to automated individualized decisions (including profiling), communicating it in writing, by sending an email to: info@intuuchina.com
                    </p>
                    <p>
                        For more information about our Privacy Policy, you can check the following email: <a href='#' data-toggle='modal' data-target='#privacyPolicy'>Privacy Policy</a>
                    </p>
                    <p>
                        INTUUCHINA Ltd
                    </p>
                ",
    'privacy policy',   "
                            <p>
                                First of all we would like to thank you for the interest you have shown in contacting IntuuChina Ltd. by providing us with your data and information.
                            </p>
                            <p>
                                We inform you that, in accordance with data protection regulations, your data will be processed by IntuuChina Ltd. as the Responsible Party with the to manage your curriculum for the selection of personnel. If your profile is not to comply with the relevant requirements in the current selection processes we will proceed to keep your data for future processes that do fit your profile, unless you tell us otherwise. We have your consent for the processing of the data you have provided us with voluntary, free and informed in order to participate in the selection processes of the organization.
                            </p>
                            <p>
                                On the other hand, we would like to inform you that we will not pass on your data to third parties, except express authorization or legal obligation. There is also no provision for transfers international to other countries. You may exercise your rights of access, rectification, deletion, opposition, limitation treatment, portability, transparency of information and not to be subject to automated individualized decisions (including profiling), by sending an e-mail to: info@intuuchina.com
                            </p>
                            <p>
                                For more information about our Privacy Policy, you can consult the following link: www.intuuchina.com
                            </p>
                            <p>
                                Without further ado, we take this opportunity to send you our warmest regards. 
                                <br/>
                                Yours sincerely, 
                                <br/>
                                INTUUCHINA Ltd
                            </p>
                        ",
    'are you in doubt' => "Are you in doubt? Contact us at <a href='mailto:" .config('mail.to.address'). "'>" .config('mail.from.address'). "</a>",



    'no offers found' => 'There are no offers which fulfill the filter criteria',
    'per hour symbol' => '/h',
    'the intuuchina team have chosen the values' => 'The IntuuChina team has chosen the values it wants to represent, and is strongly committed to the following values: effort, commitment, ambition, perseverance, uniqueness, optimism, open mind and proactivity.',
    'this team is committed and dedicated to provide' => 'This team is committed and dedicated to provide a set of personalized services that will add real value and a competitive advantage to the future professional career.',
    'are you sure you want to remove permanently job offer' => 'Are you sure you want to remove permanently :jobOffer offer?',
    'pending_confirmation status text' => 'Pending register confirmation.',
    'confirmed status text' => 'Registered.',
    'paid status text' => 'Application fee paid. You must answer him for the interview.',
    'accepted status text' => 'Accepted in the program.',
    'there are no' => 'There are no :item with such characteristic',
    'pending_deposit status text' => 'Pending the second deposit.',
    'done status text' => 'Ready to take off.',
    'joined' => 'Joined',


    /*
    |--------------------------------------------------------------------------
    | Pictures
    |--------------------------------------------------------------------------
    */

    'alt el pais' => 'El País newspaper logo',
    'alt eitb' => 'Euskal Irrati Telebisa logo',
    'alt el mundo' => 'El Mundo newspaper logo',
    'alt atresmedia' => 'Antena 3 TV channel logo',
    'alt fortune' => 'Fortune magazine logo',
    'alt tvc' => 'Televisió de Catalunya logo',
    'alt rtve' => 'Radio Televisión Española logo',
    'alt abc' => 'ABC newspaper logo',
    'alt entrepeneur' => 'Entrepeneur magazine logo',
    'alt awards' => 'Awarded people during the RTVE Emprende Contest',
    'alt what makes us different' => 'A group of IntuuChina applicants',
    'alt logo' => 'The :brand logo',

    /*
    |--------------------------------------------------------------------------
    | Forms (labels, placeholder, options, items...)
    |--------------------------------------------------------------------------
    */
    'agree' => 'Agree',
    'amount of months' => 'Amount of months roughly',
    'apply for' => 'Apply for',
    'back to home' => 'Back to Home',
    'cancel' => 'Cancel',
    'cardholder name' => 'Cardholder Name',
    'card number' => 'Card Number',
    'card expiry' => 'Card Expiry',
    'change preference' => 'Change Preference',
    'confirm' => 'Confirm',
    'continue' => 'Continue',
    'currency' => 'Currency',
    'cvc' => 'CVC',
    'cv' => 'CV',
    'delete' => 'Delete',
    'decline' => 'Decline',
    'duration' => 'Duration',
    'e-mail address' => 'E-Mail Address',
    'first name' => 'First Name',
    'home' => 'Home',
    'issue' => 'Issue',
    'i accept the' => 'I accept the ' . __('links.terms and conditions') . ' as well as the '  . __('links.general data protection regulation'),
    'i\'m also interested' => 'I\'m Also interested',
    'industry' => 'Industry',
    'join also' => 'Join Also',
    'job position' => 'Job Position',
    'months' => '{1} Month|[2,*] Months',
    'pay' => 'Pay :value',
    'per month' => "<b>:price</b> per month",
    'per hour' => "<b>:price</b> per hour",
    'per unit' => "<b>:price</b> per unit",
    'per lesson' => "<b>:price</b> per :time lesson",
    'pay now' => 'Pay Now',
    'see more' => 'See more',
    'open positions' => 'Open Positions',
    'filter by:' => 'Filter by:',
    'picture' => 'Picture',
    'phone number' => 'Phone Number',
    'ok, i got it!' => 'Ok, I got it!',
    'see your receipt' => 'See your receipt',
    'job-locations' => [
        'hong-kong' => 'Hong Kong',
        'shanghai' => 'Shanghai',
        'beijing' => 'Beijing',
        'shenzhen' => 'Shenzhen',
    ],
    'name' => 'Name',
    'surnames' => 'Surnames',
    'subject' => 'Subject',
    'submit' => 'Submit',
    'staying' => 'Staying of :time month|Staying of :time months',
    'study chinese via' => 'Study Chinese via',
    'sign in' => 'Sign In',
    'edit' => 'Editar',
    'title' => 'Title',
    'offer location label' => 'Location',
    'save' => 'Save',
    'testimonials' => 'Testimonials',
    'program' => 'Program',


    /*
    |--------------------------------------------------------------------------
    | Signatures
    |--------------------------------------------------------------------------
    */

    'made with love by ' => 'Made with love ❤ by ',
    'copyright' => 'IntuuChina Copyright © 2019 <br/>All rights reserved',
];
