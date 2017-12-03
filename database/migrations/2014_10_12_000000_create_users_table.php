<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name')->unique();
            $table->string('fname')->default('Unnamed');
            $table->string('lname')->default('Unnamed');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('user');
            $table->integer('price_type')->default(1);
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('api_token', 60)->unique()->nullable();

            $table->integer('visits')->default(0);
            $table->integer('manager_id')->default(1);

            $table->rememberToken();
            $table->timestamps();

            $table->index('name');
            $table->index('email');
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
