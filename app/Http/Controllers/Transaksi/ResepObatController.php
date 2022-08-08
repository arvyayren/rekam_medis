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
use App\Models\TransaksiResepObatHeader;
use App\Models\TransaksiResepObatDetail;

use Carbon\Carbon;

class ResepObatController extends Controller
{
    public function index()
    {
        $list = TransaksiResepObatHeader::select( 'transaksi_resep_obat_header.id','transaksi_kunjungan.no_antrian','transaksi_kunjungan.nama_pasien', 'transaksi_resep_obat_header.biaya_obat')
        ->join('transaksi_kunjungan', 'transaksi_kunjungan.id', 'transaksi_resep_obat_header.id_kunjungan')
        ->get();

        $data = array();

        foreach($list as $k => $v){

            $btnEdit = '<a href="/transaksi/resep_obat/'.$v->id.'/edit" class="btn btn-xs btn-default text-primary mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

            $data[] = array(
                $v->id,$v->no_antrian,$v->nama_pasien,$v->biaya_obat,'<nobr>'.$btnEdit.$btnDelete.'</nobr>'
            );
        }

        $kunjungan = TransaksiKunjungan::whereDate('created_at', Carbon::today())->get();

       
        return view('pages.transaksi.resep_obat.index', compact('data','kunjungan'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $kunjungan = TransaksiKunjungan::find($request->id_kunjungan);
      
        $create = TransaksiResepObatHeader::create([
            'id_kunjungan' => $request->id_kunjungan,
            'nama_pasien' => $kunjungan->nama_pasien,
            'tarif_pemeriksaan' => $kunjungan->tarif,
            'biaya_obat' => 0,
            'total_pembayaran' => 0,
        ]);

        $update = TransaksiKunjungan::where('id',$request->id_kunjungan)->update([
            'status' => 3,
        ]);

        if($create){
            return redirect('/transaksi/resep_obat')->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect('/transaksi/resep_obat')->with(['danger' => 'Data Gagal Dibuat']);
        }

    }

    public function edit($id)
    {
        $data = TransaksiResepObatHeader::select( 'transaksi_resep_obat_header.id','transaksi_kunjungan.no_antrian','transaksi_kunjungan.nama_pasien', 'transaksi_resep_obat_header.biaya_obat', 'transaksi_resep_obat_header.created_at')
        ->join('transaksi_kunjungan', 'transaksi_kunjungan.id', 'transaksi_resep_obat_header.id_kunjungan')
        ->where('transaksi_resep_obat_header.id', $id)
        ->first();

        $obat = MasterObat::get();

        $list = TransaksiResepObatDetail::select('transaksi_resep_obat_detail.id', 'master_obat.kode', 'master_obat.nama', 'transaksi_resep_obat_detail.jumlah', 'transaksi_resep_obat_detail.keterangan')
        ->join('master_obat', 'master_obat.id', 'transaksi_resep_obat_detail.id_obat')
        ->where('transaksi_resep_obat_detail.id_resep_header', $id)
        ->get();

        $resepobat = array();

        foreach($list as $k => $v){
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

            $resepobat[] = array(
                $v->id, $v->kode, $v->nama,$v->jumlah,$v->keterangan,'<nobr>'.$btnDelete.'</nobr>'
            );
        }

        return view('pages.transaksi.resep_obat.edit', compact('data','obat', 'resepobat'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);

        $update = TransaksiResepObatHeader::where('id',$id)->update([
            'biaya_obat' => $request->biaya_obat
        ]);

        if($update){
            return redirect()->back()->with(['success' => 'Data Berhasil Diubah']);
        }else{
            return redirect()->back()->with(['danger' => 'Data Gagal Diubah']);
        }
    }

    public function destroy($id)
    {
        $delete = TransaksiResepObatHeader::where('id',$id)->delete($id);

        if($delete){
            return redirect('/transaksi/resep_obat')->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect('/transaksi/resep_obat')->with(['danger' => 'Data Gagal Dihapus']);
        }
    }

    public function storeResepObat(Request $request){
        $input = $request->all();

        $create = TransaksiResepObatDetail::create($input);

        if($create){
            return redirect()->back()->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect()->back()->with(['error' => 'Data Gagal Dibuat']);
        }
    }

    public function deleteResepObat($id){
        $delete = TransaksiResepObatDetail::where('id',$id)->delete($id);

        if($delete){
            return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect()->back()->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
