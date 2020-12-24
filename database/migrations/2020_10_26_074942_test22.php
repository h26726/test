<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Test22 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test22', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('name', 100);
            $table->integer('votes');
            $table->float('amount');
            $table->boolean('confirmed');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test22');
    }
}
