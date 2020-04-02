<?php

use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker) {
    $randomIndustry =  $faker->randomElement(array_keys(__('content.industries')));

    return [
        // A latin sentence
        'title' => $faker->jobTitle,

        // Whatever date earlier than one year ago from today's date with the UTC+01:00
        'created_at' => $faker->dateTimeBetween('-1 year', 'now', 'Europe/Paris'),

        // Current date.
        'updated_at' => $faker->dateTime('now'),

        // Whatever of the jobs locations translation.
        'location' => $faker->randomElement(array_keys(__('content.job-locations'))),

        // Whatever of the elements comprises in the industry translation.
        'industry' => $randomIndustry,

        // A number between 1 Month and 24 Month
        'duration' => $faker->numberBetween($min = 1, $max = 24),

        // A delta of the QuillJS Library
        'description' => '{"ops":[{"insert":"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China."},{"attributes":{"align":"justify"},"insert":"\n"},{"insert":"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \n\n"},{"attributes":{"underline":true},"insert":"Preferred Skills"},{"attributes":{"header":4},"insert":"\n"},{"insert":"English fluency is essential."},{"attributes":{"list":"bullet"},"insert":"\n"},{"insert":"Young, sociable and energetic."},{"attributes":{"list":"bullet"},"insert":"\n"},{"insert":"Degree holder preferred."},{"attributes":{"list":"bullet"},"insert":"\n"},{"insert":"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm."},{"attributes":{"list":"bullet"},"insert":"\n"},{"insert":"\n"}]}',
    ];
});
