<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun_admin', function (Blueprint $table) {
            $table->bigIncrements('id_adm');
            $table->string('username', 25)->unique();
            $table->string('password');
            $table->string('nm_adm');

            $table->tinyInteger('roles');

            $table->string('img_adm')->nullable();
            $table->smallInteger('stat_adm')->default(1);
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
        Schema::dropIfExists('akun_admin');
    }
}
