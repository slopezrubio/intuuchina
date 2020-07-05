<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industries = [
            [
                'name' => 'Finance',
                'value' => 'finance',
                'fee_id' => DB::table('fees')
                                ->where('value', 'application_fee')->first()->id,
            ],
            [
                'name' => 'Design',
                'value' => 'design',
                'fee_id' => DB::table('fees')
                                ->where('value', 'application_fee')->first()->id,
            ],
            [
                'name' => 'Engineering',
                'value' => 'engineering',
                'fee_id' => DB::table('fees')
                                ->where('value', 'application_fee')->first()->id,
            ],
            [
                'name' => 'Consultant',
                'value' => 'consultant',
                'fee_id' => DB::table('fees')
                                ->where('value', 'application_fee')->first()->id,
            ],
            [
                'name' => 'Education',
                'value' => 'education',
                'fee_id' => DB::table('fees')
                                ->where('value', 'application_fee')->first()->id,
            ],
            [
                'name' => 'Hospitality',
                'value' => 'hospitality',
                'fee_id' => DB::table('fees')
                                ->where('value', 'application_fee')->first()->id,
            ],
            [
                'name' => 'IT',
                'value' => 'it',
                'fee_id' => DB::table('fees')
                                ->where('value', 'application_fee')->first()->id,
            ],
            [
                'name' => 'Legal',
                'value' => 'legal',
                'fee_id' => DB::table('fees')
                                ->where('value', 'application_fee')->first()->id,
            ],
            [
                'name' => 'Marketing & Business Dev.',
                'value' => 'marketing_business',
                'fee_id' => DB::table('fees')
                                ->where('value', 'application_fee')->first()->id,
            ],
            [
                'name' => 'Other',
                'value' => 'other_industries',
                'fee_id' => DB::table('fees')
                                ->where('value', 'application_fee')->first()->id,
            ],
        ];

        $degrees = [
            [
                'name' => 'M. Intl. Bsns.',
                'acronym' => 'MIB',
                'value' => 'mib',
                'fee_id' => DB::table('fees')
                    ->where('value', 'application_fee')->first()->id,
            ],
            [
                'name' => 'MBA',
                'acronym' => 'MBA',
                'value' => 'mba',
                'fee_id' => DB::table('fees')
                    ->where('value', 'application_fee')->first()->id,
            ],
            [
                'name' => 'Other',
                'value' => 'other_degrees',
                'fee_id' => DB::table('fees')
                    ->where('value', 'application_fee')->first()->id,
            ],
        ];

        $courses = [
            [
                'name' => 'In-Person',
                'value' => 'in-person','fee_id' => DB::table('fees')
                ->where('value', 'chinese_in-person_course')->first()->id,
            ],
            [
                'name' => 'Online',
                'value' => 'online',
                'fee_id' => DB::table('fees')
                    ->where('value', 'chinese_online_course')->first()->id,
            ],
        ];

        foreach ($industries as $industry) {
            factory(App\Category::class, 1)->create([
                'name' => $industry['name'],
                'acronym' => isset($industry['acronym']) ? $industry['acronym'] : null,
                'value' => $industry['value'],
                'fee_id' => $industry['fee_id']
            ])->each(function($category) {
                $category->programs()->sync([
                    DB::table('programs')->where('value', 'internship')->first()->id,
                    DB::table('programs')->where('value', 'inter_relocat')->first()->id,
                ]);
            });
        }

        foreach ($degrees as $degree) {
            factory(App\Category::class, 1)->create([
                'name' => $degree['name'],
                'acronym' => isset($degree['acronym']) ? $degree['acronym'] : null,
                'value' => $degree['value'],
                'fee_id' => $degree['fee_id']
            ])->each(function($category) {
                $category->programs()->sync([
                    DB::table('programs')->where('value', 'university')->first()->id,
                ]);
            });
        }

        foreach ($courses as $course) {
            factory(App\Category::class, 1)->create([
                'name' => $course['name'],
                'acronym' => isset($course['acronym']) ? $course['acronym'] : null,
                'value' => $course['value'],
                'fee_id' => $course['fee_id']
            ])->each(function($category) {
                $category->programs()->sync([
                    DB::table('programs')->where('value', 'study')->first()->id,
                ]);
            });
        }
    }
}
