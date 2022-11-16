<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPemusnahan;
use App\Models\Asset;

class TransaksipemusnahanController extends Controller
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
                $id_pemusnahan[]=$request->id_pemusnahan;
                $data=[
                    'id_pemusnahan'=>$id_pemusnahan[$i],
                    'id_asset'=>$request->id_asset[$i],
                ];

                TransaksiPemusnahan::create($data);
                Asset::find($request->id_asset[$i])->update(['status_aset'=>'Proses Pemusnahan']);
            }
            return redirect('asset/pemusnahan/'.$request->id_pemusnahan);
        } else {
           $data=[
            'id_pemusnahan'=>$request->id_pemusnahan,
            'id_asset'=>$request->id_asset
        ];

        TransaksiPemusnahan::create($data);
        Asset::find($request->id_asset)->update(['status_aset'=>'Proses Pemusnahan']);
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
        TransaksiPemusnahan::find($request->id_transaksi)->delete();
        Asset::find($request->id_asset)->update(['status_aset'=>'Tersedia']);
        return redirect('asset/pemusnahan/'.$request->id_pemusnahan);
    }
}