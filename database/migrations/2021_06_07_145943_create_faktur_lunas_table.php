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
            $table->date('tgl_lunas');
            $table->string('ket');
            $table->bigInteger('user_id')->unsigned();
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
