<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterPasien;
use App\Models\MasterDokter;
use App\Models\MasterObat;
use App\Models\TransaksiKunjungan;
use App\Models\TransaksiRekamMedisHeader;
use App\Models\TransaksiRekamMedisDetail;
use App\Models\TransaksiResepObat;

class ResepObatController extends Controller
{
    public function index()
    {
        $list = TransaksiRekamMedisHeader::select( 'transaksi_rekam_medis_header.id','master_pasien.no_registrasi_pasien','master_pasien.nama', 'master_pasien.jenis_kelamin', 'master_pasien.alamat')
        ->join('master_pasien', 'master_pasien.id', 'transaksi_rekam_medis_header.id_pasien')
        ->get();

        $data = array();

        foreach($list as $k => $v){

            $btnEdit = '<a href="/transaksi/rekam_medis/'.$v->id.'/edit" class="btn btn-xs btn-default text-primary mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

            $data[] = array(
                $v->id,$v->no_registrasi_pasien,$v->nama,$v->jenis_kelamin,$v->alamat,'<nobr>'.$btnEdit.$btnDelete.'</nobr>'
            );
        }

        $pasien = MasterPasien::get();

       
        return view('pages.transaksi.rekam_medis.index', compact('data','pasien'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
      
        $create = TransaksiRekamMedisHeader::create($input);

        if($create){
            return redirect('/transaksi/rekam_medis')->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect('/transaksi/rekam_medis')->with(['danger' => 'Data Gagal Dibuat']);
        }

    }

    public function edit($id)
    {
        $data = TransaksiRekamMedisHeader::select( 'transaksi_rekam_medis_header.id','master_pasien.no_registrasi_pasien','master_pasien.nama', 'master_pasien.jenis_kelamin', 'master_pasien.alamat')
        ->join('master_pasien', 'master_pasien.id', 'transaksi_rekam_medis_header.id_pasien')
        ->first();

        $dokter = MasterDokter::get();
        $kunjungan = TransaksiKunjungan::whereDate('created_at', Carbon::today())->get();

        $list = TransaksiRekamMedisDetail::select('transaksi_rekam_medis_detail.id', 'transaksi_kunjungan.no_antrian', 'transaksi_rekam_medis_detail.tanggal_pemeriksaan', 'transaksi_rekam_medis_detail.anamnesa_pemeriksaan', 'transaksi_rekam_medis_detail.rujuk_pengobatan')
        ->join('transaksi_kunjungan', 'transaksi_kunjungan.id', 'transaksi_rekam_medis_detail.id_kunjungan')
        ->join('master_dokter', 'master_dokter.id', 'transaksi_rekam_medis_detail.id_dokter')
        ->where('transaksi_rekam_medis_detail.id_rekam_medis_header', $id)->get();

        $rekammedis = array();

        foreach($list as $k => $v){
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

            $rekammedis[] = array(
                $v->id, $v->no_antrian,$v->tanggal_pemeriksaan,$v->anamnesa_pemeriksaan,$v->rujuk_pengobatan,'<nobr>'.$btnDelete.'</nobr>'
            );
        }

        return view('pages.transaksi.rekam_medis.edit', compact('data','dokter', 'kunjungan', 'rekammedis'));
    }

    public function storeRekamMedis(Request $request){
        $input = $request->all();

        $create = TransaksiRekamMedisDetail::create($input);

        if($create){
            return redirect()->back()->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect()->back()->with(['error' => 'Data Gagal Dibuat']);
        }
    }

    public function deleteRekamMedis($id){
        $delete = TransaksiRekamMedisDetail::where('id',$id)->delete($id);

        if($delete){
            return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect()->back()->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
