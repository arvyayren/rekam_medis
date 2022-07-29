<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterPasien;

class DaftarPasienBaruController extends Controller
{
    public function index()
    {
        $list = MasterPasien::select('id','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','no_ktp',
        'umur','alamat','jenis_pasien','tanggal_pendaftaran')->orderBy('tanggal_pendaftaran','desc')->get();

        $data = array();

        foreach($list as $k => $v){

            $data[] = array(
                $v->id,$v->tanggal_pendaftaran,$v->nama,$v->no_ktp,$v->tempat_lahir,$v->tanggal_lahir,
                $v->jenis_kelamin,$v->umur,$v->alamat,$v->jenis_pasien
            );
        }

        return view('pages.transaksi.daftar_pasien_baru', compact('data'));
    }
}
