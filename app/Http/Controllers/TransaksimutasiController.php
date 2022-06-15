<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksimutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        if (is_array($request->id_asset)) {
            $jml=count($request->id_asset);
            for ($i=0; $i < $jml ; $i++) {
                $id_mutasi[]=$request->id_mutasi;
                $data=[
                    'id_mutasi'=>$id_mutasi[$i],
                    'id_asset'=>$request->id_asset[$i]
                ];

                DB::table('transaksi_mutasi')->insert($data);

                DB::table('asset')->where('id_asset',$request->id_asset[$i])->update(['status_mutasi'=>1]);
            }

            return redirect('asset/mutasi/'.$request->id_mutasi);
        } else {
           $data=[
            'id_mutasi'=>$request->id_mutasi,
            'id_asset'=>$request->id_asset
        ];

        DB::table('transaksi_mutasi')->insert($data);

        DB::table('asset')->where('id_asset',$request->id_asset)->update(['status_mutasi'=>1]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('transaksi_mutasi')->where('id_transaksi',$request->id_transaksi)->delete();
        DB::table('asset')->where('id_asset',$request->id_asset)->update(['status_mutasi'=>0]);
        return redirect('asset/mutasi/'.$request->id_mutasi);
    }
}
