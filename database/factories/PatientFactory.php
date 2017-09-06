<?php

use App\Entities\Patient;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Patient::class, function (Faker\Generator $faker) {
    $bloodTypes = [
        'A+',
        'A-',
        'B+',
        'B-',
        'AB+',
        'AB-',
        'O+',
        'O-'
    ];

    $sex = [
        'm',
        's'
    ];

    return [
        'name'                  => $faker->name,
        'birthday_date'         => $faker->dateTime,
        'sex'                   => $faker->randomElement($sex),
        'cpf'                   => rand(100, 999) . '.' . rand(100, 999) . '.' . rand(100, 999) . '-' . rand(10,
                99),
        'rg'                    => rand(10, 99) . '.' . rand(100, 999) . '.' . rand(100, 999),
        'address'               => $faker->streetName,
        'neighborhood'          => $faker->word,
        'number'                => $faker->buildingNumber,
        'zipcode'               => $faker->numerify('12345-678'),
        'allergic'              => $faker->boolean,
        'sus_card'              => rand(100, 999) . '.' . rand(1000, 9999) . '.' . rand(1000,
                9999) . '.' . rand(1000,
                9999),
        'marital_status'        => $faker->numberBetween(0, 4),
        'height'                => $faker->randomFloat(2, 0, 2.5),
        'weight'                => $faker->randomFloat(2, 0, 300),
        'birth_height'          => $faker->randomFloat(2, 0, 0.5),
        'birth_weight'          => $faker->randomFloat(2, 0, 10),
        'birth_cephalic_length' => $faker->randomFloat(2, 0, 40),
        'birth_type'            => $faker->boolean,
        'blood_type'            => $faker->randomElement($bloodTypes),
        'city_id'               => $faker->numberBetween(1, 5570),
        'naturalness_id'        => $faker->numberBetween(1, 5570)
    ];
});