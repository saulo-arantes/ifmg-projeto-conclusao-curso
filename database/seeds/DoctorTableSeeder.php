<?php

use App\Entities\Doctor;
use App\Entities\User;
use Illuminate\Database\Seeder;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class, 5)->create(['level' => User::DOCTOR])->each(function ($user) {
            factory(Doctor::class)->create(['user_id' => $user->id]);
        });
    }
}
