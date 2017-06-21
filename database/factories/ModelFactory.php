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
        'complement'     => $faker->word,
        'email'          => $faker->unique()->safeEmail,
        'level'          => $faker->numberBetween(0, 2),
        'name'           => $faker->name,
        'neighborhood'   => $faker->word,
        'number'         => $faker->buildingNumber,
        'password'       => $password ?: $password = bcrypt('secret'),
        'status'         => $faker->boolean(),
        'zipcode'        => $faker->numerify('12.345-678'),
        'remember_token' => str_random(10)
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