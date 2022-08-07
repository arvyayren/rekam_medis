<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TransaksiResepObatHeader;
use App\Models\Pembayaran;
use App\Models\TransaksiKunjungan;

use Carbon\Carbon;

class PembayaranController extends Controller
{
    public function index()
    {
        $list = Pembayaran::select('transaksi_pembayaran.id', 'transaksi_pembayaran.created_at', 'transaksi_kunjungan.no_antrian', 'transaksi_resep_obat_header.nama_pasien', 'transaksi_resep_obat_header.tarif_pemeriksaan', 'transaksi_resep_obat_header.biaya_obat', 'transaksi_pembayaran.total_pembayaran', 'transaksi_pembayaran.status')
        ->join('transaksi_resep_obat_header', 'transaksi_resep_obat_header.id', 'transaksi_pembayaran.id_resep_header')
        ->join('transaksi_kunjungan', 'transaksi_kunjungan.id', 'transaksi_resep_obat_header.id_kunjungan')
        ->get();

        $data = array();

        foreach($list as $k => $v){

            if($v->status == null){
                $lunas = '<button type="submit" form="lunas'.$v->id.'" class="btn btn-xs btn-default text-success mx-1 shadow">
                                <i class="fa fa-lg fa-fw fa-check-circle"></i> Lunas
                            </button>';
            }else{
                $lunas = '';
            }

            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

            $data[] = array(
                $v->id,$v->created_at,$v->no_antrian,$v->nama_pasien, $v->tarif_pemeriksaan,$v->biaya_obat,$v->total_pembayaran,$v->status,'<nobr>'.$lunas.$btnDelete.'</nobr>'
            );
        }

        $resep = TransaksiResepObatHeader::select('transaksi_resep_obat_header.id', 'transaksi_kunjungan.no_antrian', 'transaksi_resep_obat_header.nama_pasien')
        ->join('transaksi_kunjungan', 'transaksi_kunjungan.id', 'transaksi_resep_obat_header.id_kunjungan')
        ->whereDate('transaksi_kunjungan.created_at', Carbon::today())
        ->get();

        return view('pages.transaksi.pembayaran.index', compact('data','resep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $resep = TransaksiResepObatHeader::find($request->id_resep_header);

        $create = Pembayaran::create([
            'id_resep_header' =>$request->id_resep_header,
            'total_pembayaran' =>$resep->tarif_pemeriksaan + $resep->biaya_obat,
            'status' =>'',
        ]);

        if($create){
            return redirect('/transaksi/pembayaran')->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect('/transaksi/pembayaran')->with(['danger' => 'Data Gagal Dibuat']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);

        $update = Pembayaran::where('id',$id)->update([
            'status' => 'Lunas'
        ]);

        $pembayaran = Pembayaran::find($id);

        $kunjungan = TransaksiResepObatHeader::find($pembayaran->id_resep_header);

        $update_kunjungan = TransaksiKunjungan::where('id',$kunjungan->id_kunjungan)->update([
            'status' => 4,
        ]);

        if($update){
            return redirect()->back()->with(['success' => 'Data Berhasil Diubah']);
        }else{
            return redirect()->back()->with(['danger' => 'Data Gagal Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Pembayaran::where('id',$id)->delete($id);

        if($delete){
            return redirect('/transaksi/pembayaran')->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect('/transaksi/pembayaran')->with(['danger' => 'Data Gagal Dihapus']);
        }
    }
}
