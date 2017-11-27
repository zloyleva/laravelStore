<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sku');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();

            $table->float('price_user');
            $table->float('price_3_opt');
            $table->float('price_8_opt');
            $table->float('price_dealer');
            $table->float('price_vip');
            
            $table->integer('category_id');
            $table->integer('stock');
            $table->boolean('featured');
            $table->string('image');

            $table->integer('views')->default(0);
            $table->integer('sales_count')->default(0);
            $table->float('rate')->default(0);

            $table->timestamps();

            $table->unique('sku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
