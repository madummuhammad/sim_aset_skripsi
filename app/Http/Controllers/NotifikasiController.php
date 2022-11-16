<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['notifikasi']=DB::table('notifikasi')->orderBy('id','DESC')->get();
        // DB::table('notifikasi')->where('read_at',NULL)->update(['read_at'=>date('Y-m-d H:i:s')]);
        return view('notifikasi',$data);

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
        DB::table('notifikasi')->where('id',$request->id_notifikasi)->update(['read_at'=>date('Y-m-d H:i:s')]);
        return redirect('notifikasi');
    }

    public function store_notifikasi_pengajuan_mutasi($id_mutasi)
    {

        $transaksi_mutasi=DB::table('transaksi_mutasi')->where('id_mutasi',$id_mutasi)->get();

        foreach ($transaksi_mutasi as $key => $value) {
            $datanotifikiasi=[
                'jenis_notifikasi'=>'Pengajuan Mutasi',
                'keterangan'=>'Ada pengajuan Mutasi',
                'id_asset'=>$value->id_asset,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            DB::table('notifikasi')->insert($datanotifikiasi);
        }
    }

    public function store_notifikasi_persetujuan_mutasi($id_mutasi)
    {

        $transaksi_mutasi=DB::table('transaksi_mutasi')->where('id_mutasi',$id_mutasi)->get();

        foreach ($transaksi_mutasi as $key => $value) {
            $datanotifikiasi=[
                'jenis_notifikasi'=>'Persetujuan Mutasi',
                'keterangan'=>'Pengajuan Mutasi Disetujui',
                'id_asset'=>$value->id_asset,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            DB::table('notifikasi')->insert($datanotifikiasi);
        }
    }

    public function store_notifikasi_pengajuan_pemusnahan($id_pemusnahan)
    {

        $transaksi_pemusnahan=DB::table('transaksi_pemusnahan')->where('id_pemusnahan',$id_pemusnahan)->get();

        foreach ($transaksi_pemusnahan as $key => $value) {
            $datanotifikiasi=[
                'jenis_notifikasi'=>'Pengajuan Pemusnahan',
                'keterangan'=>'Ada pengajuan pemusnahan',
                'id_asset'=>$value->id_asset,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            DB::table('notifikasi')->insert($datanotifikiasi);
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
        //
    }
}