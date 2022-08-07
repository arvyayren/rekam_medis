<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiResepObatHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_resep_obat_header';

    protected $fillable = ['id_kunjungan','nama_pasien','tarif_pemeriksaan','biaya_obat', 'total_pembayaran',
    'created_at','updated_at'];
}
