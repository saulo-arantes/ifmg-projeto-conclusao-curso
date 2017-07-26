<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoctorPatientsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doctor_patients', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('doctor_id');
			$table->foreign('doctor_id')->references('id')->on('doctors');
			$table->unsignedInteger('patient_id');
			$table->foreign('patient_id')->references('id')->on('patients');
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
		Schema::drop('doctor_patients');
	}

}
