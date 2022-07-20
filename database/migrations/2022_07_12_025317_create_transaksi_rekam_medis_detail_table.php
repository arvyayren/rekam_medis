<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiRekamMedisDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_rekam_medis_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kunjungan')->nullable();
            $table->integer('id_krekam_medis_header')->nullable();
            $table->text('anamnesa_pemeriksaan')->nullable();
            $table->text('rujuk_pengobatan')->nullable();
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
        Schema::dropIfExists('transaksi_rekam_medis_detail');
    }
}
