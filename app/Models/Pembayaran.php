<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pembayaran';

    protected $fillable = ['id_resep_header','total_pembayaran','status',
    'created_at','updated_at'];
}
