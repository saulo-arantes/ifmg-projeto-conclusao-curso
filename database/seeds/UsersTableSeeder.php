<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 *
 * @author Saulo Vinícius
 */
class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(User::class)->create([
			'email'        => 'saulovinicius@gmail.com',
			'name'         => 'Saulo Vinícius',
			'password'     => bcrypt('saulo123'),
			'role'         => User::ADMIN,
			'address' 	   => 'Rua Exemplo',
			'number'       => '125',
			'neighborhood' => 'Bairro Exemplo',
			'complement'   => 'Casa',
			'zipcode'      => '35570-000',
			'status'	   => 1
		]);
	}
}
