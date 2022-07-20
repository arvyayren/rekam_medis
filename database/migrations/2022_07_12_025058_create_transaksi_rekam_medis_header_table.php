<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiRekamMedisHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_rekam_medis_header', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pasien')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->string('hubungan_keluarga')->nullable();
            $table->integer('umur')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('nama_peserta')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->text('alamat_rumah')->nullable();
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->integer('no')->nullable();
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
        Schema::dropIfExists('transaksi_rekam_medis_header');
    }
}
