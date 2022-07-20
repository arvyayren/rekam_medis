<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDokter extends Model
{
    use HasFactory;

    protected $table = 'master_dokter';

    protected $fillable = ['nama','spesialis','created_at','updated_at'];
}
