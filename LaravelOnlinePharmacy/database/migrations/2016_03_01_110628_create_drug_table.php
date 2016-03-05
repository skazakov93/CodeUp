<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('desc');
            $table->string('img_url');
            $table->timestamps();
        });

        Schema::create('drug_pharmacies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drug_id')->unsigned()->index();
            $table->integer('pharmacy_id')->unsigned()->index();
            $table->integer('drug_price');

            $table->foreign('drug_id')->references('id')->on('drugs');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('cascade');
        });

        Schema::create('drug_pharmacy_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drug_pharmacy_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('delivery_price');

            $table->foreign('drug_pharmacy_id')->references('id')->on('drug_pharmacies');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('drugs');
        Schema::drop('drug_pharmacy');
        Schema::drop('dist_drug_pharmacy');
    }
}
