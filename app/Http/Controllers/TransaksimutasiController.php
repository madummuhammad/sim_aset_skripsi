<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asset;
use App\Models\TransaksiMutasi;
use Validator;

class TransaksimutasiController extends Controller
{

    public function store(Request $request)
    {
        $validator=Validator::make(['id_mutasi'=>$request->id_mutasi],[
            'id_mutasi'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'error','message'=>'Gagal melakukan mutasi']);
        }

        if(count($request->asset)==0){
            return response()->json(['status'=>'error','message'=>'Gagal melakukan mutasi']);
        }

        for ($i=0; $i < count($request->asset); $i++) {
            $data[$i]=[
                'id_mutasi'=>$request->id_mutasi,
                'id_asset'=>$request->asset[$i]['id_asset'],
                'kode_lokasi_sebelumnya'=>$request->asset[$i]['lokasi_sebelumnya'],
            ];

            TransaksiMutasi::create($data[$i]);
            Asset::find($request->asset[$i]['id_asset'])->update(['status_aset'=>'Proses Mutasi']);
        }

        return response()->json(['status'=>'success','message'=>'Berhasil menambahkan  mutasi']);

    }

    public function destroy(Request $request)
    {
        TransaksiMutasi::find($request->id_transaksi)->delete();
        Asset::find($request->id_asset)->update(['status_aset'=>'Tersedia']);
        return redirect('asset/mutasi/'.$request->id_mutasi);
    }
}
