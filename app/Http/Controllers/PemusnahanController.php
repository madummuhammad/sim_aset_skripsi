<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemusnahan;
use App\Models\Asset;
use App\Models\TransaksiPemusnahan;
use App\Http\Controllers\AssetController;

class PemusnahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pemusnahan']=Pemusnahan::all();
        return view('pemusnahan',$data);
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
        $data=[
            'id_pemusnahan'=>$request->id_pemusnahan,
            'nama'=>$request->nama,
            'penanggung_jawab'=>auth()->user()->id_user,
            'deskripsi'=>$request->deskripsi,
            'status_pemusnahan'=>"Proses pemusnahan"
        ];
        Pemusnahan::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_pemusnahan)
    {
        $data['pemusnahan']=Pemusnahan::with('users')->find($id_pemusnahan);
        $data['asset']=TransaksiPemusnahan::with('asset')->where('id_pemusnahan',$id_pemusnahan)->get();

        $data['inventory']=AssetController::Allasset();
        return view('showpemusnahan',$data);
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
        $id_pemusnahan=$request->id_pemusnahan;
        if ($request->status==NULL) {
            $data=[
                'nama'=>$request->nama,
                'penanggung_jawab'=>auth()->user()->id_user,
                'deskripsi'=>$request->deskripsi,
                'status_pemusnahan'=>'Proses Pemusnahan'
            ];
            Pemusnahan::find($id_pemusnahan)->update($data);
            return redirect('asset/pemusnahan/'.$id_pemusnahan);
        } else {
            NotifikasiController::store_notifikasi_pengajuan_pemusnahan($id_pemusnahan);
            Pemusnahan::find($id_pemusnahan)->update(['status_pemusnahan'=>$request->status]);
            return redirect('asset/pemusnahan/'.$id_pemusnahan);
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
        $id_pemusnahan=Request('id_pemusnahan');
        Pemusnahan::find($id_pemusnahan)->delete();
        TransaksiPemusnahan::where('id_pemusnahan',$id_pemusnahan)->delete();
        if ($request->id_asset !== NULL) {
            $jml=count($request->id_asset);
            for ($i=0; $i < $jml ; $i++) {
                Asset::where('id_asset',$request->id_asset[$i])->update(['status_aset'=>'Tersedia']);
            }
        }
        return redirect('asset/pemusnahan');
    }
}