<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorisktTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiskt', function (Blueprint $table) {
            $table->bigIncrements('id_his');

            $table->char('nik_wrg');
            $table->foreign('nik_wrg')->references('nik_wrg')->on('warga');

            $table->date('tgl_skt');
            $table->date('tgl_sls');
            $table->date('tgl_smb');

            $table->tinyInteger('st_skt');
            $table->tinyInteger('stat_skt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historiskt');
    }
}
