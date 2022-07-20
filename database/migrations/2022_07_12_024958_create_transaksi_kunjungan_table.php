<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiKunjunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_kunjungan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pasien')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->date('tanggal_kunjungan')->nullable();
            $table->integer('no_antrian')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_kunjungan');
    }
}
