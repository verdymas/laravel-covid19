<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBantuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bantuan', function (Blueprint $table) {
            $table->bigIncrements('id_ban');
            $table->integer('jml_ban');
            $table->date('tgl_ban');

            $table->bigInteger('id_kk')->unsigned();
            $table->foreign('id_kk')->references('id_kk')->on('kk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bantuan');
    }
}
