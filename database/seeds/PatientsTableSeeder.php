<?php

use App\Entities\DoctorPatient;
use App\Entities\Patient;
use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Patient::class, 100)->create()->each(function ($patient) {
            DoctorPatient::create([
                'patient_id' => $patient->id,
                'doctor_id'  => rand(1, 5)
            ]);
        });
    }
}
