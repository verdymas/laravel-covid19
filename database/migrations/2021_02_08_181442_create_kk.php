<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kk', function (Blueprint $table) {
            $table->bigIncrements('id_kk');
            $table->string('no_kk', 100)->unique();

            $table->bigInteger('id_adm')->unsigned();
            $table->foreign('id_adm')->references('id_adm')->on('akun_admin');

            $table->smallInteger('stat_kk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kk');
    }
}
