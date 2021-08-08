<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailNotaLuringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_nota_lurings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('master_nota_luring_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('unit');
            $table->string('harga');
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
        Schema::dropIfExists('detail_nota_lurings');
    }
}
