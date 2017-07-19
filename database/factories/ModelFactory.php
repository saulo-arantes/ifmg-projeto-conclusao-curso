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
$factory->define( App\Entities\User::class, function ( Faker\Generator $faker ) {
	static $password;

	return [
		'address'        => $faker->streetName,
		'complement'     => $faker->word,
		'email'          => $faker->unique()->safeEmail,
		'level'          => $faker->numberBetween( 0, 2 ),
		'name'           => $faker->name,
		'neighborhood'   => $faker->word,
		'number'         => $faker->buildingNumber,
		'password'       => $password ?: $password = bcrypt( 'secret' ),
		'status'         => $faker->boolean,
		'zipcode'        => rand( 10000, 99999 ) . '-' . rand( 100, 999 ),
		'remember_token' => str_random( 10 )
	];
} );


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
$factory->define( App\Entities\Log::class, function ( Faker\Generator $faker ) {
	return [
		'description' => $faker->words( 8, true ),
		'type'        => $faker->numberBetween( 0, 3 ),
		'user_id'     => $faker->numberBetween( 1, 50 )
	];
} );


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
$factory->define( App\Entities\Patients::class, function ( Faker\Generator $faker ) {
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

	$sex = [ 'm', 's' ];

	return [
		'name'                  => $faker->name,
		'birthday_date'         => $faker->dateTime,
		'sex'                   => $faker->randomElement( $sex ),
		'cpf'                   => rand( 100, 999 ) . '.' . rand( 100, 999 ) . '.' . rand( 100, 999 ) . '-' . rand( 10,
				99 ),
		'rg'                    => rand( 10, 99 ) . '.' . rand( 100, 999 ) . '.' . rand( 100, 999 ),
		'address'               => $faker->streetName,
		'neighborhood'          => $faker->word,
		'number'                => $faker->buildingNumber,
		'zipcode'               => $faker->numerify( '12345-678' ),
		'allergic'              => $faker->boolean,
		'sus_card'              => rand( 100, 999 ) . '.' . rand( 1000, 9999 ) . '.' . rand( 1000,
				9999 ) . '.' . rand( 1000,
				9999 ),
		'marital_status'        => $faker->numberBetween( 0, 4 ),
		'height'                => $faker->randomFloat( 2, 0, 2.5 ),
		'weight'                => $faker->randomFloat( 2, 0, 300 ),
		'birth_height'          => $faker->randomFloat( 2, 0, 0.5 ),
		'birth_weight'          => $faker->randomFloat( 2, 0, 10 ),
		'birth_cephalic_length' => $faker->randomFloat( 2, 0, 40 ),
		'birth_type'            => $faker->boolean,
		'blood_type'            => $faker->randomElement( $bloodTypes ),
		'city_id'               => $faker->numberBetween( 1, 5570 ),
		'naturalness_id'        => $faker->numberBetween( 1, 5570 )
	];
} );

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
$factory->define( App\Entities\ContactType::class, function ( Faker\Generator $faker ) {
	return [
		'name' => $faker->word
	];
} );
