<?php

use App\Preference;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    const AMOUNT_OF_TESTING_SEEDS = 3;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        $this->deleteProfileFolders();

        $admin = factory(User::class, 1)->create([
            'id' => 1,
            'name' => 'Fernando',
            'surnames' => 'de Zavala Carvajal',
            'email' => 'fernando.zavala@intuuchina.com',
            'type' => 'admin',
            'cv' => null,
            'phone_number' => array(
                'prefix' => 'esp',
                'number' => '659566062',
             ),
            'status_id' => null,
            'password' => Hash::make('***********'),
            'api_token' => Str::random(60),
        ]);

        for ($i = 0; $i <= self::AMOUNT_OF_TESTING_SEEDS; $i++) {
            factory(User::class, 1)->create([
                'id' => DB::table('users')->orderBy('id', 'desc')->first()->id + 1,
            ])->each(function($user) use ($faker) {
                $categories = DB::table('category_program')
                                ->where('program_id', $user->program_id)
                                ->inRandomOrder()
                                ->limit($faker->numberBetween(0, DB::table('category_program')->where('program_id', $user->program_id)->count()))
                                ->pluck('category_id');

                $user->categories()->attach($categories);
            });
        }
    }

    protected function deletePublicProfileFolders() {
        $publicUserProfiles = Storage::directories('public/profiles');

        foreach($publicUserProfiles as $profileFolder) {
            Storage::deleteDirectory($profileFolder);
        }

        return $this;
    }

    protected function deletePrivateProfilesFolders() {
        $privateUserProfiles = Storage::directories('profiles');

        foreach($privateUserProfiles as $profileFolder) {
            Storage::deleteDirectory($profileFolder);
        }

        return $this;
    }

    protected function deleteProfileFolders() {
        $this->deletePrivateProfilesFolders()
            ->deletePublicProfileFolders();
    }
}
