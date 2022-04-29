<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->string('title');
            $table->string('start_date');
            $table->string('expire_date');
            $table->string('city');
            $table->string('image');
            $table->string('address');
            $table->integer('entry_amount');
            $table->string('description');
            $table->string('status');
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
        Schema::dropIfExists('trades');
    }
}
