<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKunjungan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_kunjungan';

    protected $fillable = ['id_pasien','nama_pasien','tanggal_kunjungan','no_antrian','status',
    'created_at','updated_at'];
}
