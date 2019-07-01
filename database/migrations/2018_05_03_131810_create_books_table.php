<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
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
            $table->string('name', 100);
            $table->float('origin_price');
            $table->float('sell_price');
            $table->string("author", 100);
            $table->string('category', 100);
            $table->string('introduction', 100);
            $table->string('pic', 100); 
            $table->string('press', 100);
            $table->string('status', 100);
            $table->string('owner_id', 100);
            $table->string('link', 100);
        }

    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
