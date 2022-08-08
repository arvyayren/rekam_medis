<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterPasien;

use Auth;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->email == 'admin@admin.com'){
            $list = MasterPasien::select('id','nama','tempat_lahir','tanggal_lahir','jenis_kelamin', 'no_registrasi_pasien', 'no_hp')->get();
        }else{
            $list = MasterPasien::select('id','nama','tempat_lahir','tanggal_lahir','jenis_kelamin', 'no_registrasi_pasien', 'no_hp')
            ->where('nama', Auth::user()->name)
            ->get();
        }
        $data = array();

        foreach($list as $k => $v){

            $btnEdit = '<a href="/master/pasien/'.$v->id.'/edit" class="btn btn-xs btn-default text-primary mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';

            $btnPrint = '<a href="/master/pasien/'.$v->id.'/print" class="btn btn-xs btn-default text-primary mx-1 shadow">
                <i class="fa fa-lg fa-fw fa-print"></i>
            </a>';

            if(Auth::user()->email == 'admin@admin.com'){
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';
            }else{
                $btnDelete = '';
            }
            $data[] = array(
                $v->id, $v->no_registrasi_pasien,$v->nama,$v->tempat_lahir,$v->tanggal_lahir,$v->jenis_kelamin,$v->no_hp,'<nobr>'.$btnEdit.$btnDelete.$btnPrint.'</nobr>'
            );
        }

        return view('pages.pasien.index', compact('data'));
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

        $tahun = date('Y');
        
        $bulan = date('m');

        $no = 1;

        $check = MasterPasien::whereYear('created_at', '=', $tahun)
        ->whereMonth('created_at', '=', $bulan)
        ->get();

        $max = count($check);

        if($max > 0){
            $no_registrasi_pasien = 'RG' . $tahun . $bulan . sprintf("%04s", abs($max + 1));
        }else{
            $no_registrasi_pasien = 'RG' . $tahun . $bulan . sprintf("%04s", $no);
        }    

        $create = MasterPasien::create([
            'no_registrasi_pasien' => $no_registrasi_pasien,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_ktp' => $request->no_ktp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
            'jenis_pasien' => $request->jenis_pasien,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
            'no_hp' => $request->no_hp
        ]);



        if($create){
            return redirect('/master/pasien')->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect('/master/pasien')->with(['danger' => 'Data Gagal Dibuat']);
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
        $data = MasterPasien::find($id);

        return view('pages.pasien.edit', compact('data'));
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

        $update = MasterPasien::where('id',$id)->update($input);

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
        $delete = MasterPasien::where('id',$id)->delete($id);

        if($delete){
            return redirect('/master/pasien')->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect('/master/pasien')->with(['danger' => 'Data Gagal Dihapus']);
        }
    }

    public function print($id)
    {
        $data = MasterPasien::find($id);

        return view('pages.pasien.kartu', compact('data'));
    }
}
