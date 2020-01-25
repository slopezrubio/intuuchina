<?php

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
        //
        foreach (range(0, 2) as $userIndex) {
            $offset = 1;
            $id = User::getLastUserCreated()->id + $offset;

            $user = factory(User::class, 1)->create([
                'id' => $id,
                'name' => ['Santiago', 'Maria Alejandra', 'Mario'][$userIndex],
                'surnames' => ['Barba Bullón de Mendoza', 'Sanabria Aguilar', 'Juárez Camacho'][$userIndex],
                'avatar' => Storage::putFile('public/profiles/'. $id, new File(public_path('storage/images/test_files/testimonial_' . ($userIndex + $offset) . '.jpg')), 'public'),
            ]);

            $testimonial = factory(Testimonial::class)->create([
                'quotes' => json_encode([
                    'es' => '',
                    'en' => [
                        'Inntuchina was my go-to partner for everything China related',
                        'They are a very focused and intelligent people who develop a very successful company',
                        'IntuuChina is a great one-stop shop that really makes your life easier'
                    ][$userIndex],
                ]),
                'occupation' => ['Junior Analyst', 'BD Executive', 'Digital Analyst'][$userIndex],
                'company' => [null, 'SIP Project Management', null][$userIndex],
                'user_id' => $id,
            ]);
        }
    }
}
