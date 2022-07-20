<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiResepObat extends Model
{
    use HasFactory;

    protected $table = 'transaksi_resep_obat';

    protected $fillable = ['id_kunjungan','nama_obat','jumlah','keterangan',
    'created_at','updated_at'];
}
