<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientContactsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 150);
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedInteger('contact_type_id');
            $table->foreign('contact_type_id')->references('id')->on('contact_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patient_contacts');
    }

}
