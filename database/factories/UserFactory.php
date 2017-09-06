<?php

use \App\Entities\User;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'address'        => $faker->streetName,
        'complement'     => $faker->word,
        'email'          => $faker->unique()->safeEmail,
        'role'           => $faker->randomElement([User::ADMIN, User::DOCTOR, User::SECRETARY]),
        'name'           => $faker->name,
        'neighborhood'   => $faker->word,
        'number'         => $faker->buildingNumber,
        'password'       => $password ?: $password = bcrypt('secret'),
        'status'         => $faker->boolean,
        'zipcode'        => rand(10000, 99999) . '-' . rand(100, 999),
        'remember_token' => str_random(10)
    ];
});
