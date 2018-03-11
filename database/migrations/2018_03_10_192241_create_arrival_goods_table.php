<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrivalGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrival_goods', function (Blueprint $table) {
            $table->increments('id');

            $table->string('price_user')->unique();
            $table->string('price_3_opt')->unique();
            $table->string('price_8_opt')->unique();
            $table->string('price_dealer')->unique();
            $table->string('price_vip')->unique();
            $table->date('arrival_date');
            $table->boolean('publish')->default(true);

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
        Schema::dropIfExists('arrival_goods');
    }
}
