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
            $table->integer('category_id')->nullable();
            $table->integer('seller_id')->nullable(); 
            $table->integer('available')->nullable();
            $table->string('product_name');
            $table->string('product_image');
            $table->longText('description');
            $table->string('sku');
            $table->decimal('price',10,2);
            $table->decimal('sell_price',10,2);
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
