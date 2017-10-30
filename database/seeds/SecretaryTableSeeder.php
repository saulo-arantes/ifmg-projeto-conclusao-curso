<?php

use App\Entities\Secretary;
use App\Entities\User;
use Illuminate\Database\Seeder;

/**
 * Class SecretaryTableSeeder
 *
 * @author Saulo Vinícius
 */
class SecretaryTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class, 5)->create(['role' => User::SECRETARY])->each(function ($user) {
            factory(Secretary::class)->create(['user_id' => $user->id]);
        });
    }

}