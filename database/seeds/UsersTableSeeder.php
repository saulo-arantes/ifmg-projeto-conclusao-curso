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
            'email'    => 'saulo@email.com',
            'name'     => 'Saulo',
            'password' => bcrypt('123456'),
            'role'    => User::ADMIN

        ]);

        factory(User::class, 50)->create();
    }
}
