<?php

use App\Entities\ContactType;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(ContactType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});
