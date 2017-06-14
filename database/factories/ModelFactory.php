<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Entities\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'address'        => $faker->streetName,
        'name'           => $faker->name,
        'number'         => $faker->buildingNumber,
        'neighborhood'   => $faker->word,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'level'          => $faker->numberBetween(0, 2)
    ];
});


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Entities\Log::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->words(8, true),
        'type'        => $faker->numberBetween(0, 3),
        'user_id'     => $faker->numberBetween(1, 50)
    ];
});