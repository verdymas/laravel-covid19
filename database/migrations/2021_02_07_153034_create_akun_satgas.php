<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunSatgas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun_satgas', function (Blueprint $table) {
            $table->bigIncrements('id_stg');
            $table->string('username', 25)->unique();
            $table->string('password');
            $table->string('nm_stg');
            $table->string('img_stg');
            $table->smallInteger('stat_stg');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akun_satgas');
    }
}
