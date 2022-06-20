<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanmutasiController extends Controller
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
        return view('laporanmutasi',$data);
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
        //
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
       return view('showlaporanmutasi',$data);
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
        $status=$request->status;

        if ($status==1) {
            DB::table('mutasi')->where('id_mutasi',$id_mutasi)->update(['status_mutasi'=>2]);
        } else {
            DB::table('mutasi')->where('id_mutasi',$id_mutasi)->update(['status_mutasi'=>1]);
        }

        return redirect('laporan/mutasi');
    }

    public function pdf($id_mutasi)
    {
        $data['lokasi']=DB::table('lokasi')->get();

        $data['mutasi']=DB::table('mutasi')->join('lokasi','mutasi.lokasi','=','lokasi.kode_lokasi')->join('users','mutasi.penanggung_jawab','=','users.id_user')->where('id_mutasi',$id_mutasi)->first();
        // $data['mutasi']=DB::table('mutasi')->where('id_mutasi',$id_mutasi)->join('lokasi','mutasi.lokasi','=','lokasi.kode_lokasi')->first();

        $data['asset']= DB::table('transaksi_mutasi')->join('asset','transaksi_mutasi.id_asset','=','asset.id_asset')->join('lokasi','asset.kode_lokasi','=','lokasi.kode_lokasi')->where('id_mutasi',$id_mutasi)->get();

        $data['inventory']=AssetController::Allasset();

        // return view('laporanmutasipdf',$data);

        $pdf = PDF::loadview('laporanmutasipdf',$data);
        return $pdf->download('laporan-mutasi.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
