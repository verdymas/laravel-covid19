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
            $table->char('nik_wrg', 16);
            $table->primary('nik_wrg');

            $table->text('nm_wrg');
            $table->string('tmplhr_wrg');
            $table->date('tgllhr_wrg');
            $table->tinyInteger('jk_wrg');
            $table->text('almt_wrg');
            $table->tinyInteger('stat_wrg');

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
