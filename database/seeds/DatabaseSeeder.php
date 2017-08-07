<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * @author Saulo Vinícius
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(DoctorTableSeeder::class);
        $this->call(LogsTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(ContactTypeTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
    }
}
