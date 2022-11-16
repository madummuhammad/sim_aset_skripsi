<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asset;
use App\Models\TransaksiMutasi;

class TransaksimutasiController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $lokasi_sebelumnya=Asset::find($request->id_asset)->first();
        if (is_array($request->id_asset)) {
            $jml=count($request->id_asset);
            for ($i=0; $i < $jml ; $i++) {
                $id_mutasi[]=$request->id_mutasi;
                $data=[
                    'id_mutasi'=>$id_mutasi[$i],
                    'id_asset'=>$request->id_asset[$i],
                    'kode_lokasi_sebelumnya'=>$lokasi_sebelumnya->kode_lokasi
                ];

                TransaksiMutasi::create($data);
                Asset::find($request->id_asset[$i])->update(['status_aset'=>'Proses Mutasi']);
            }

            return redirect('asset/mutasi/'.$request->id_mutasi);
        } else {
           $data=[
            'id_mutasi'=>$request->id_mutasi,
            'id_asset'=>$request->id_asset,
            'kode_lokasi_sebelumnya'=>$request->kode_lokasi
        ];

        TransaksiMutasi::create($data);
        Asset::find($request->id_asset)->update(['status_aset'=>'Proses Mutasi']);
    }

}

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        TransaksiMutasi::find($request->id_transaksi)->delete();
        Asset::find($request->id_asset)->update(['status_aset'=>'Tersedia']);
        return redirect('asset/mutasi/'.$request->id_mutasi);
    }
}
