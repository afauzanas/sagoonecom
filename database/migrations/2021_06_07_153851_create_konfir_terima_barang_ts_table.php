<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonfirTerimaBarangTsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfir_terima_barang_ts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pengiriman_barang_t_id')->unsigned();
            $table->timestamps();
            $table->date('tgl_terima');
            $table->bigInteger('user_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konfir_terima_barang_ts');
    }
}
