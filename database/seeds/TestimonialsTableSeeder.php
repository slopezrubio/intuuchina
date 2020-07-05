<?php

use App\Program;
use App\User;
use App\Testimonial;
use Faker\Generator as Faker;
use Illuminate\Http\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestimonialsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = [
            [
                'name' => 'Santiago',
                'surname' => 'Barba Bullón de Mendoza',
                'program_id' => 1,
                'testimonial' => [
                    'quotes' => json_encode([
                        'es' => '',
                        'en' => 'Inntuchina was my go-to partner for everything China related',
                    ]),
                    'occupation' => 'Junior Analyst',
                    'company' => null,
                ],
            ],
            [
                'name' => 'Maria Alejandra',
                'surname' => 'Sanabria Aguilar',
                'program_id' => 1,
                'testimonial' => [
                    'quotes' => json_encode([
                        'es' => '',
                        'en' => 'They are a very focused and intelligent people who develop a very successful company',
                    ]),
                    'occupation' => 'BD Executive',
                    'company' => 'SIP Project Management',
                ]
            ],
            [
                'name' => 'Mario',
                'surname' => 'Juárez Camacho',
                'program_id' => 1,
                'testimonial' => [
                    'quotes' => json_encode([
                        'es' => '',
                        'en' => 'IntuuChina is a great one-stop shop that really makes your life easier',
                    ]),
                    'occupation' => 'Digital Analyst',
                    'company' => null,
                ]
            ],
            [
                'name' => 'Cesar',
                'surname' => 'Vázquez Parra',
                'program_id' => 1,
                'testimonial' => [
                    'quotes' => json_encode([
                        'es' => '',
                        'en' => 'With clear objectives, they led me to the best opportunities in the area of my interest.'
                    ]),
                    'occupation' => 'Marketing',
                    'company' => null,
                ]
            ],
            [
                'name' => 'Rocco',
                'surname' => 'Forgione',
                'program_id' => 1,
                'testimonial' => [
                    'quotes' => json_encode([
                        'es' => '',
                        'en' => 'At first, I was a bit scared to come to China alone. But at the end I knew IntuuChina would help me in my first months',
                    ]),
                    'occupation' => 'Double Master\'s Degree Student',
                    'company' => 'ZJU China Studies',
                ]
            ],
            [
                'name' => 'Angela',
                'surname' => 'Blanco',
                'program_id' => 1,
                'testimonial' => [
                    'quotes' => json_encode([
                        'es' => '',
                        'en' => 'Together we have all created the IntuuChina family, which is a big community with people having the same values and beliefs.',
                    ]),
                    'occupation' => 'Administrative',
                    'company' => null,
                ]
            ],

        ];

        //
        foreach ($users as $key => $user) {
            $offset = 1;
            $id = User::getLastUserCreated()->id + $offset;

            factory(User::class, 1)->create([
                'id' => $id,
                'name' => $user['name'],
                'surnames' => $user['surname'],
                'avatar' => Storage::putFileAs('public/profiles/'. $id, new File(public_path('storage/images/test_files/testimonial_' . ($key + $offset) . '.jpg')), Program::find($user['program_id'])->value . '_china_' . str_replace(' ', '_', strtolower($user['name'])) . '.jpg', 'public'),
                'program_id' => $user['program_id']
            ]);

            $testimonial = factory(Testimonial::class)->create([
                'quotes' => $user['testimonial']['quotes'],
                'occupation' => $user['testimonial']['occupation'],
                'company' => $user['testimonial']['company'],
                'user_id' => $id,
            ]);
        }
    }
}
