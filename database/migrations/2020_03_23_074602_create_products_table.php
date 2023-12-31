<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name', '30');
            $table->string('code', '20');
            $table->mediumInteger('stock')->default(0);
            $table->string('uom', '10')->nullable();
            $table->float('price');
            $table->smallInteger('shop_id');
            $table->boolean('show_in_bot')->default(true);
            $table->tinyInteger('state')->default(1);
            $table->integer('category_id')->nullable();
            $table->string('variant_combination_ids', 100)->nullable();
            $table->integer('parent_product_id')->nullable();
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
        Schema::dropIfExists('products');
    }
}
