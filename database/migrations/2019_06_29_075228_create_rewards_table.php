<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("issuer_id");
            $table->integer('applier_id');
            $table->integer("order_id");
            $table->string("book_name", 100);
            $table->string("book_author", 100);
            $table->string('book_category', 100);
            $table->string('book_pic', 100); 
            $table->string('book_press', 100);
            $table->float("book_price");
            $table->string("status", 100);
            $table->string("description", 100);
            $table->integer("book_id");
            
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
        Schema::dropIfExists('rewards');
    }
}
