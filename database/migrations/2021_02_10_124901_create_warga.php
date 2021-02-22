<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->bigIncrements('id_wrg');
            $table->text('nm_wrg');
            $table->string('tmplhr_wrg');
            $table->date('tgllhr_wrg');
            $table->smallInteger('jk_wrg');
            $table->text('almt_wrg');
            $table->text('skt_wrg');
            $table->smallInteger('statskt_wrg');
            $table->smallInteger('stat_wrg');

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
        Schema::dropIfExists('warga');
    }
}
