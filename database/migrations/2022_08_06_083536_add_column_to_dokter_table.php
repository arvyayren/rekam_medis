<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_dokter', function (Blueprint $table) {
            $table->string('no_ktp');
            $table->string('tempat_tgl_lahir');
            $table->string('jenis_kelamin');
            $table->string('umur');
            $table->text('alamat');
            $table->string('no_hp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_dokter', function (Blueprint $table) {
            //
        });
    }
}
