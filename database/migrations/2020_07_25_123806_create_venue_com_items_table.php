<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueComItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venue_com_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vanue_id')->unsigned()->nullable();
            $table->foreign('vanue_id')->references('id')->on('venue_master')->onDelete('cascade')->update('cascade');
            $table->string('item_name');
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
        Schema::dropIfExists('venue_com_items');
    }
}
