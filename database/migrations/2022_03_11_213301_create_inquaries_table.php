<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquaries', function (Blueprint $table) {
            $table->string('vendor_name');
            $table->integer('vendor_id');
            $table->string('product_name');
            $table->integer('product_id');
            $table->string('description');
            $table->integer('quantity');
            $table->string('assistance');
            $table->string('attachment');
            $table->string('description');
            $table->string('price_at_vendor');
            $table->string('video_call');
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
        Schema::dropIfExists('inquaries');
    }
}
