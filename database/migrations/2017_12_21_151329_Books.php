<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Books extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('title');
            $table->text('resume')->nullable();
            $table->decimal('unit_price', 9, 3);

            // area 
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('area');
        });

        Schema::create('book_themes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books');

            $table->integer('theme_id')->unsigned();
            $table->foreign('theme_id')->references('id')->on('themes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_themes');
        Schema::dropIfExists('books');
    }
}
