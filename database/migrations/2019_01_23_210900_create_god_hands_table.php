<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGodHandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('god_hands', function (Blueprint $table) 
        {
            $table->increments('id');
            
            $table->integer('product_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->integer('quantity');
            
            $table->string('action');

            $table->integer('quantity_move')->nullable();
            $table->integer('target_location_id')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            // Foreign Key Constraints
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('god_hands');
    }
}
