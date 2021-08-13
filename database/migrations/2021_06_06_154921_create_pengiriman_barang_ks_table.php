<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanBarangKsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman_barang_ks', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur')->unique();
            $table->timestamps();
            $table->bigInteger('order_kredit_disetujui_id')->unsigned();
            $table->foreign('order_kredit_disetujui_id')->references('id')->on('order_kredit_disetujuis');
            $table->date('tgl_kirim');
            $table->string('ongkir');
            $table->date('estimasi_sampai');
            $table->bigInteger('ekspedisi_id')->unsigned();
            $table->foreign('ekspedisi_id')->references('id')->on('ekspedisis');
            $table->string('resi_pengiriman');
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
        Schema::dropIfExists('pengiriman_barang_ks');
    }
}
