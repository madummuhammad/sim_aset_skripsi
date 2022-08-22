<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\NotifikasiController;

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['lokasi']=DB::table('lokasi')->get();

        $data['mutasi']= DB::table('mutasi')->join('lokasi','mutasi.lokasi','=','lokasi.kode_lokasi')->get();

        return view('mutasi',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
            'id_mutasi'=>$request->id_mutasi,
            'nama'=>$request->nama,
            'lokasi'=>$request->lokasi,
            'penanggung_jawab'=>auth()->user()->id_user,
            'deskripsi'=>$request->deskripsi,
            'status_mutasi'=>0
        ];

        DB::table('mutasi')->insert($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_mutasi)
    {
        $data['lokasi']=DB::table('lokasi')->get();
        
        $data['mutasi']=DB::table('mutasi')->join('lokasi','mutasi.lokasi','=','lokasi.kode_lokasi')->join('users','mutasi.penanggung_jawab','=','users.id_user')->where('id_mutasi',$id_mutasi)->first();
        // $data['mutasi']=DB::table('mutasi')->where('id_mutasi',$id_mutasi)->join('lokasi','mutasi.lokasi','=','lokasi.kode_lokasi')->first();

        $data['asset']= DB::table('transaksi_mutasi')->join('asset','transaksi_mutasi.id_asset','=','asset.id_asset')->join('lokasi','asset.kode_lokasi','=','lokasi.kode_lokasi')->where('id_mutasi',$id_mutasi)->get();

        $data['inventory']=AssetController::Allasset();

        return view('showmutasi',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id_mutasi=$request->id_mutasi;
        if ($request->status==NULL) {
            $data=[
                'nama'=>$request->nama,
                'lokasi'=>$request->lokasi,
                'penanggung_jawab'=>auth()->user()->id_user,
                'deskripsi'=>$request->deskripsi,
                'status_mutasi'=>0
            ];

            DB::table('mutasi')->where('id_mutasi',$id_mutasi)->update($data);
            return redirect('asset/mutasi/'.$id_mutasi);
        } else {
            NotifikasiController::store_notifikasi_pengajuan_mutasi($id_mutasi);
            DB::table('mutasi')->where('id_mutasi',$id_mutasi)->update(['status_mutasi'=>$request->status]);
            return redirect('asset/mutasi/'.$id_mutasi);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('mutasi')->where('id_mutasi',$request->id_mutasi)->delete();
        if ($request->id_asset !== NULL) {
            $jml=count($request->id_asset);
            for ($i=0; $i < $jml ; $i++) {

                DB::table('asset')->where('id_asset',$request->id_asset[$i])->update(['status_mutasi'=>0]);
            }
        }
        return redirect('asset/mutasi');
    }
}
