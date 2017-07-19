<?php

use App\Entities\ContactType;
use Illuminate\Database\Seeder;

class ContactTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(ContactType::class)->create(['name' => 'Telefone']);
	    factory(ContactType::class)->create(['name' => 'Celular']);
	    factory(ContactType::class)->create(['name' => 'E-mail']);
	    factory(ContactType::class)->create(['name' => 'Skype']);
    }
}
