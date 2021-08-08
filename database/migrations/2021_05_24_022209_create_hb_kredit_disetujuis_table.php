<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHbKreditDisetujuisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hb_kredit_disetujuis', function (Blueprint $table) {
            $table->id();
            $table->string('no_kredit_disetujui')->unique();
            $table->bigInteger('permintaan_hb_kredit_id')->unsigned();
            $table->timestamps();
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
        Schema::dropIfExists('hb_kredit_disetujuis');
    }
}
