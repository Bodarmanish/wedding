<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueExCostItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venue_ex_cost_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vanue_id')->unsigned()->nullable();
            $table->foreign('vanue_id')->references('id')->on('venue_master')->onDelete('cascade')->update('cascade');
            $table->string('item_name');
            $table->string('price');
            $table->string('des');
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
        Schema::dropIfExists('venue_ex_cost_items');
    }
}
