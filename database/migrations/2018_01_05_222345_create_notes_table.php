<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('views')->nullable();
            $table->float('rate')->nullable();
            $table->boolean('type_news')->default(false);
            $table->boolean('type_shares')->default(false);
            $table->boolean('type_reviews')->default(false);
            $table->boolean('type_articles')->default(true);
            $table->string('thumbnail');

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
        Schema::dropIfExists('notes');
    }
}
