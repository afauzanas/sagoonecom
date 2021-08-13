<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturLunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faktur_lunas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pengiriman_barang_k_id')->unsigned();
            $table->foreign('pengiriman_barang_k_id')->references('id')->on('pengiriman_barang_ks');
            $table->date('tgl_lunas');
            $table->string('ket');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('faktur_lunas');
    }
}
