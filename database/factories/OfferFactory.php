<?php

use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'created_at' => $faker->dateTimeBetween('-1 year', 'now', 'Europe/Paris'),
        'updated_at' => $faker->dateTime('now'),
        'location' => $faker->randomElement(array('shangai', 'beijing')),
        'job_type' => $faker->randomElement(array('shangai', 'beijing')),
        'education' => $faker->randomElement(array('graduate_degree', 'bachelor_degree')),
        'duration' => $faker->regexify('^(10|11|12|[0-9]) ([Mm]onth[s]?)$'),
        'description' => $faker->text(190),
        'preferred_skills' => $faker->text(190),
        'non_technical_skills' => $faker->text(190)
    ];
});
