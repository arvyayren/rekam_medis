<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_obat', function (Blueprint $table) {
            $table->date('tgl_registrasi');
            $table->date('tgl_expired');
            $table->string('jenis', 16);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_obat', function (Blueprint $table) {
            //
        });
    }
}
