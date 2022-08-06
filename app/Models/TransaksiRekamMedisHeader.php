<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiRekamMedisHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_rekam_medis_header';

    protected $fillable = ['id_pasien', 'created_at','updated_at'];
}
