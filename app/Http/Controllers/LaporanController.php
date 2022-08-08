<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterPasien;
use App\Models\MasterDokter;
use App\Models\MasterObat;
use App\Models\TransaksiKunjungan;
use App\Models\TransaksiRekamMedisHeader;
use App\Models\TransaksiRekamMedisDetail;
use App\Models\TransaksiResepObatHeader;
use App\Models\TransaksiResepObatDetail;
use App\Models\Pembayaran;

use DB;

class LaporanController extends Controller
{
    public function obat(request $request){
        $data = TransaksiResepObatDetail::select('master_obat.kode', 'master_obat.nama', DB::raw('SUM(transaksi_resep_obat_detail.jumlah) as jumlah'))
        ->join('master_obat', 'master_obat.id', 'transaksi_resep_obat_detail.id_obat')
        ->whereMonth('transaksi_resep_obat_detail.created_at', $request->bulan)
        ->groupBy([
            'master_obat.kode', 
            'master_obat.nama'
        ])
        ->get();

        $no = 1;
        $compactData = [
            'data' => $data,
            'no' => $no
        ];
        return view('laporan.obat', $compactData);
    }

    public function kunjungan(request $request){
        $data = TransaksiKunjungan::select('master_pasien.no_registrasi_pasien', 'master_pasien.nama', 'master_pasien.jenis_pasien', 'master_pasien.umur', DB::raw('COUNT(transaksi_kunjungan.id) as jumlah_kunjungan'))
        ->join('master_pasien', 'master_pasien.id', 'transaksi_kunjungan.id_pasien')
        ->whereMonth('transaksi_kunjungan.created_at', $request->bulan)
        ->groupBy([
            'master_pasien.no_registrasi_pasien', 
            'master_pasien.nama',
            'master_pasien.jenis_pasien',
            'master_pasien.umur'
        ])
        ->get();

        $no = 1;
        $compactData = [
            'data' => $data,
            'no' => $no
        ];
        return view('laporan.kunjungan', $compactData);
    }

    public function pembayaran(request $request){
        $data = Pembayaran::select('transaksi_pembayaran.created_at', 'transaksi_kunjungan.no_antrian', 'transaksi_kunjungan.nama_pasien', 'transaksi_pembayaran.total_pembayaran', 'transaksi_pembayaran.status')
        ->join('transaksi_resep_obat_header', 'transaksi_resep_obat_header.id', 'transaksi_pembayaran.id_resep_header')
        ->join('transaksi_kunjungan', 'transaksi_kunjungan.id', 'transaksi_resep_obat_header.id_kunjungan')
        ->whereMonth('transaksi_pembayaran.created_at', $request->bulan)
        ->get();

        $no = 1;
        $compactData = [
            'data' => $data,
            'no' => $no
        ];
        return view('laporan.pembayaran', $compactData);
    }

}
