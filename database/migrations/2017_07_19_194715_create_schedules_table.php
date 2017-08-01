<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schedules', function(Blueprint $table) {
            $table->increments('id');
			$table->dateTime('start_at');
			$table->dateTime('finish_at');
			$table->string('description')->nullable();
			$table->unsignedInteger('status')->default(1)->comment('1-Criado, 2-Confirmado, 3-Cancelado, 4-Realizado');
//			$table->unsignedInteger('doctor_id');
//			$table->foreign('doctor_id')->references('id')->on('doctors');
//			$table->unsignedInteger('patient_id');
//			$table->foreign('patient_id')->references('id')->on('patients');
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
		Schema::drop('schedules');
	}

}
