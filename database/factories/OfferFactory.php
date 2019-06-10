<?php

use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'created_at' => $faker->dateTimeBetween('-1 year', 'now', 'Europe/Paris'),
        'updated_at' => $faker->dateTime('now'),
        'location' => $faker->randomElement(array('shanghai', 'beijing', 'hongkong')),
        'industry' => $faker->randomElement(array('finance', 'design', 'consultant', 'educaton', 'it', 'legal')),
        'duration' => $faker->randomElement(array(1,2,3,4,5,6,7,8,9,10,11,12)),
        'picture' => $faker->regexify('storage/images/generic_finance_picture' . $faker->randomElement(array(1,2,3)) . '\.jpg'),
        'description' => $faker->text(190),
        'preferred_skills' => $faker->text(190),
    ];
});
