<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPasien extends Model
{
    use HasFactory;

    protected $table = 'master_pasien';

    protected $fillable = ['nama','tempat_lahir','tanggal_lahir','no_ktp','jenis_kelamin','umur',
    'alamat','jenis_pasien','tanggal_pendaftaran','created_at','updated_at', 'no_registrasi_pasien'];
}
