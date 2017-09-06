<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Entities\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->string('complement', 100)->nullable();
            $table->string('email')->unique();
            $table->enum('role', [User::ADMIN, User::DOCTOR, User::SECRETARY]);
            $table->string('name');
            $table->string('neighborhood', 100);
            $table->string('number', 10);
            $table->string('password');
            $table->string('photo')->nullable();
            $table->boolean('status')->defaut(1);
            $table->string('zipcode', 9);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
