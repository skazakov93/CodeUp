<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNestedCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nested_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('desc');
            $table->integer('user_id')->unsigned();
            $table->integer('comment_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');//migriraj pak
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nested_comments');
    }
}
