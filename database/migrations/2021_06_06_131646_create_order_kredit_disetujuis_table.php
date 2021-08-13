<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderKreditDisetujuisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_kredit_disetujuis', function (Blueprint $table) {
            $table->id();
            $table->string('no_order_disetujui')->unique();
            $table->bigInteger('master_order_k_id')->unsigned();
            $table->foreign('master_order_k_id')->references('id')->on('master_order_ks');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->string('token');
            $table->date('dl_bayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_kredit_disetujuis');
    }
}
