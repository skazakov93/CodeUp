<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voter_id')->unsigned();
            $table->integer('delivery_id')->unsigned();
            $table->integer('drug_pharmacy_id')->unsigned();
            $table->integer('result');


            $table->foreign('voter_id')->references('id')->on('users');
            $table->foreign('delivery_id')->references('id')->on('users');
            $table->foreign('drug_pharmacy_id')->references('id')->on('drug_pharmacy_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('votes');
    }
}
