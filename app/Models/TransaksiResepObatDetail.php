<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiResepObatDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_resep_obat_detail';

    protected $fillable = ['id_resep_header','id_obat','jumlah','keterangan',
    'created_at','updated_at'];
}
