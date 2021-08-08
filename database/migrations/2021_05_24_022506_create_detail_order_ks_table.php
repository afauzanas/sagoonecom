<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailOrderKsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_order_ks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('master_order_k_id')->unsigned();
            $table->foreign('master_order_k_id')->references('id')->on('master_order_ks');
            $table->bigInteger('product_id')->unsigned();
            $table->integer('qty');
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
        Schema::dropIfExists('detail_order_ks');
    }
}
