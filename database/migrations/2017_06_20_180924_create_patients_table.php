<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('photo', 250)->nullable();
            $table->date('birthday_date');
            $table->char('sex', 1);
            $table->unsignedTinyInteger('type')->nullable()->comment('0 = Idoso, 1 = Gestante, 2 = Deficiente, 3 = Lactante');
            $table->string('cpf', 14)->nullable()->unique();
            $table->string('rg', 20)->nullable()->unique();
            $table->string('address');
            $table->string('neighborhood');
            $table->string('number', 10);
            $table->string('complement')->nullable();
            $table->string('zipcode', 20);
            $table->boolean('allergic')->default(1);
            $table->string('sus_card', 25)->nullable();
            $table->string('observation', 400)->nullable();
            $table->unsignedTinyInteger('marital_status')->nullable()->comment('0 = solteiro, 1 = casado, 2 = divorciado, 3 = viúvo, 4 = separado');
            $table->decimal('height', 3, 2)->nullable();
            $table->decimal('weight', 6, 3)->nullable();
            $table->decimal('birth_height', 3, 2)->nullable();
            $table->decimal('birth_weight', 6, 3)->nullable();
            $table->decimal('birth_cephalic_length', 4, 2)->nullable();
            $table->boolean('birth_type')->nullable()->comment('0 = normal, 1 = cesária');
            $table->string('blood_type', 3)->nullable();
            $table->unsignedInteger('father_id')->nullable();
            $table->foreign('father_id')->references('id')->on('patients');
            $table->unsignedInteger('mother_id')->nullable();
            $table->foreign('mother_id')->references('id')->on('patients');
            $table->integer('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->cascade();
            $table->integer('naturalness_id');
            $table->foreign('naturalness_id')->references('id')->on('cities');
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
        Schema::drop('patients');
    }

}
