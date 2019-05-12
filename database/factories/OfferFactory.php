<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'created_at' => $faker->dateTimeBetween();
        'updated_at' => $faker->dateTime(),
        'location' => $faker->randomElement(array('shangai', 'beijing')),
        'job_type' => $faker->randomElement(array('shangai', 'beijing')),
        'education' => $faker->randomElement(array('graduate_degree', 'bachelor_degree')),
        'duration' => $faker->regexify([0-9])
    ];
});
