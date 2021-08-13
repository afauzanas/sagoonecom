<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonfirTerimaBarangKsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfir_terima_barang_ks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pengiriman_barang_k_id')->unsigned();
            $table->foreign('pengiriman_barang_k_id')->references('id')->on('pengiriman_barang_ks');
            $table->timestamps();
            $table->date('tgl_terima');
            $table->bigInteger('user_id')->unsigned();
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
        Schema::dropIfExists('konfir_terima_barang_ks');
    }
}
