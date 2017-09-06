<?php

use App\Entities\Doctor;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Doctor::class, function (Faker\Generator $faker) {
    return [
        'crm' => rand(10000000, 99999999) . '-' . rand(1, 9) . '/BR'
    ];
});

