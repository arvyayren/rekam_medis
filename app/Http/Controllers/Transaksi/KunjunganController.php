<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterPasien;

use App\Models\TransaksiKunjungan;

class KunjunganController extends Controller
{
    public function index()
    {
        $list = TransaksiKunjungan::select('id','nama_pasien','tanggal_kunjungan','no_antrian','status')->get();

        $data = array();

        foreach($list as $k => $v){

            $btnEdit = '<a href="/transaksi/kunjungan/'.$v->id.'/edit" class="btn btn-xs btn-default text-primary mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

            if($v->status == 1){
                $status = 'Dalam Antrian';
            }
            
            if($v->status == 2){
                $status = 'Ke Ruangan Dokter';
            }
            
            if($v->status == 3){
                $status = 'Pengambilan Obat';
            }
            
            if($v->status == 4){
                $status = 'Selesai';
            }

            $data[] = array(
                $v->id,$v->nama_pasien,$v->tanggal_kunjungan,$v->no_antrian,$status,'<nobr>'.$btnEdit.$btnDelete.'</nobr>'
            );
        }

        $pasien = MasterPasien::get();

        $status = array(
            1 => 'Dalam Antrian',
            2 => 'Ke Ruangan Dokter',
            3 => 'Pengambilan Obat',
            4 => 'Selesai',
        );

        return view('pages.transaksi.kunjungan.index', compact('data','pasien','status'));
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
        $input['nama_pasien'] = MasterPasien::where('id',$input['id_pasien'])->value('nama');

        $last = TransaksiKunjungan::where('tanggal_kunjungan',$input['tanggal_kunjungan'])
        ->orderBy('no_antrian', 'desc')->first();

        if(isset($last)){
            $no = $last->no_antrian+1;
            $no = substr($no, -4);

            $input['no_antrian'] = date('Ymd',strtotime($input['tanggal_kunjungan'])).$no;
        }else{
            $input['no_antrian'] = date('Ymd',strtotime($input['tanggal_kunjungan'])).'0001';
        }

        $create = TransaksiKunjungan::create($input);

        if($create){
            return redirect('/transaksi/kunjungan')->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect('/transaksi/kunjungan')->with(['danger' => 'Data Gagal Dibuat']);
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
    public function edit($id)
    {
        $data = TransaksiKunjungan::find($id);

        $pasien = MasterPasien::get();

        $status = array(
            1 => 'Dalam Antrian',
            2 => 'Ke Ruangan Dokter',
            3 => 'Pengambilan Obat',
            4 => 'Selesai',
        );

        return view('pages.transaksi.kunjungan.edit', compact('data','pasien','status'));
    }

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

        $update = TransaksiKunjungan::where('id',$id)->update($input);

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
        $delete = TransaksiKunjungan::where('id',$id)->delete($id);

        if($delete){
            return redirect('/transaksi/kunjungan')->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect('/transaksi/kunjungan')->with(['danger' => 'Data Gagal Dihapus']);
        }
    }
}
