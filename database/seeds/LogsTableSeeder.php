<?php

use App\Entities\Log;
use Illuminate\Database\Seeder;

/**
 * Class LogsTableSeeder
 *
 * @author Saulo Vinícius
 */
class LogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Log::class, 5)->create();
    }
}
