<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiRekamMedisDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_rekam_medis_detail';

    protected $fillable = ['id_kunjungan', 'id_dokter', 'id_rekam_medis_header', 'tanggal_pemeriksaan', 'anamnesa_pemeriksaan','rujuk_pengobatan',
    'created_at','updated_at'];
}
