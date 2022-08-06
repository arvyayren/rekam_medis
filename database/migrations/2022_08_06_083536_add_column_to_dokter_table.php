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
            $table->string('no_ktp', 16);
            $table->string('tempat_tgl_lahir', 35);
            $table->string('jenis_kelamin', 10);
            $table->string('umur', 3);
            $table->text('alamat');
            $table->string('no_hp', 13);
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
