<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\NotifikasiController;
use App\Models\Mutasi;
use App\Models\Lokasi;
use App\Models\Asset;
use App\Models\User;
use App\Models\TransaksiMutasi;

class MutasiController extends Controller
{
    public function index()
    {
        $data['mutasi']=Mutasi::with('lokasi')->get();
        return view('mutasi',$data);
    }
    public function create()
    {

    }

    public function store(Request $request)
    {
        $data=[
            'id_mutasi'=>$request->id_mutasi,
            'nama'=>$request->nama,
            'kode_lokasi'=>$request->lokasi,
            'penanggung_jawab'=>auth()->user()->id_user,
            'deskripsi'=>$request->deskripsi,
            'status_mutasi'=>"Proses Mutasi"
        ];

        Mutasi::create($data);
    }

    public function show($id_mutasi)
    {
        $data['lokasi']=Lokasi::get();
        $data['mutasi']=Mutasi::with('lokasi')->with('users')->find($id_mutasi);
        $data['asset']=TransaksiMutasi::with('asset')->with('lokasi')->where('id_mutasi',$id_mutasi)->get();

        $data['inventory']=AssetController::Allasset();
        return view('showmutasi',$data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        $id_mutasi=$request->id_mutasi;
        if ($request->status==NULL) {
            $data=[
                'nama'=>$request->nama,
                'kode_lokasi'=>$request->lokasi,
                'penanggung_jawab'=>auth()->user()->id_user,
                'deskripsi'=>$request->deskripsi,
                'status_mutasi'=>'Proses Mutasi'
            ];

            Mutasi::find($id_mutasi)->update($data);
            return redirect('asset/mutasi/'.$id_mutasi);
        } else {
            NotifikasiController::store_notifikasi_pengajuan_mutasi($id_mutasi);
            Mutasi::find($id_mutasi)->update(['status_mutasi'=>$request->status]);
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
        $id_mutasi=request('id_mutasi');
        Mutasi::find($id_mutasi)->delete();
        TransaksiMutasi::where('id_mutasi',$id_mutasi)->delete();
        if ($request->id_asset !== NULL) {
            $jml=count($request->id_asset);
            for ($i=0; $i < $jml ; $i++) {
                Asset::where('id_asset',$request->id_asset[$i])->update(['status_aset'=>'Tersedia']);
            }
        }
        return redirect('asset/mutasi');
    }
}