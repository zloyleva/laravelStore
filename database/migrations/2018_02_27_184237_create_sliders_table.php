<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 255);
            $table->string('img_url', 255);
            $table->boolean('show_status')->default(false);
            $table->string('link_url', 255)->nullable();
            $table->boolean('light_theme')->default(false);
            $table->string('text_title', 255)->nullable();
            $table->text('text_content')->nullable();
            $table->string('text_button', 255)->nullable();
            $table->integer('position')->default(0);

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
        Schema::dropIfExists('sliders');
    }
}
