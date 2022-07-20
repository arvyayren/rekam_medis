<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiRekamMedisHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_rekam_medis_header';

    protected $fillable = ['id_pasien','nama_pasien','hubungan_keluarga','umur','jenis_kelamin',
    'nama_peserta','nama_perusahaan','alamat_rumah','tanggal_pemeriksaan','no', 'created_at','updated_at'];
}
