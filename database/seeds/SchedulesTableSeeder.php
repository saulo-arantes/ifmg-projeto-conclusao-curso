<?php

use App\Entities\Schedule;
use Illuminate\Database\Seeder;

/**
 * Class SchedulesTableSeeder
 *
 * @author Saulo Vinícius
 * @since 07/08/2017
 */
class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Schedule::class, 10)->create([
            'doctor_id' => rand(1, 5),
            'patient_id' => rand(1, 100)
        ]);

    }
}