<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPersediaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_persediaans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('master_persediaan_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('unit_masuk');
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
        Schema::dropIfExists('detail_persediaans');
    }
}
