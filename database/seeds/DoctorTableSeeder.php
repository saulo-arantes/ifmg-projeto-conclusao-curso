<?php

use App\Entities\Doctor;
use App\Entities\User;
use Illuminate\Database\Seeder;

/**
 * Class DoctorTableSeeder
 *
 * @author Saulo Vinícius
 */
class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class, 1)->create(['role' => User::DOCTOR])->each(function ($user) {
            factory(Doctor::class)->create(['user_id' => $user->id]);
        });
    }
}
