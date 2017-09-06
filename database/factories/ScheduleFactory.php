<?php

use App\Entities\Schedule;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Schedule::class, function (Faker\Generator $faker) {
    $date = $faker->dateTimeBetween('-30 days', '+30 days');

    return [
        'start_at'    => $date,
        'finish_at'   => $date,
        'description' => $faker->words(3, true),
        'status'      => rand(1, 4)
    ];
});
