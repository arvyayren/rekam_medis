<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiResepObatHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_resep_obat_header', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kunjungan')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->decimal('tarif_pemeriksaan', 16,2)->nullable();
            $table->decimal('biaya_obat', 16,2)->nullable();
            $table->decimal('total_pembayaran', 16,2)->nullable();
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
        Schema::dropIfExists('transaksi_resep_obat_header');
    }
}
