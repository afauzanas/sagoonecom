<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterOrderKsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_order_ks', function (Blueprint $table) {
            $table->id();
            $table->string('no_order')->unique();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->string('alamat_terima');
            $table->bigInteger('metode_bayar_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_order_ks');
    }
}
