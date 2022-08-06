<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterObat extends Model
{
    use HasFactory;

    protected $table = 'master_obat';

    protected $fillable = ['kode','nama','created_at','updated_at', 'tgl_expired', 'tgl_registrasi', 'jenis'];
}
