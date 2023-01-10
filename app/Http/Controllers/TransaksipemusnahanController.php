<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPemusnahan;
use App\Models\Asset;
use Validator;

class TransaksipemusnahanController extends Controller
{
    public function store(Request $request)
    {
        $validator=Validator::make(['id_pemusnahan'=>$request->id_pemusnahan],[
            'id_pemusnahan'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'error','message'=>'Gagal melakukan mutasi']);
        }


        if(count($request->asset)==0)
        {
            return response()->json(['status'=>'error','message'=>'Gagal melakukan mutasi']);
        }

        for ($i=0; $i < count($request->asset); $i++) {
            $data[$i]=[
                'id_pemusnahan'=>$request->id_pemusnahan,
                'id_asset'=>$request->asset[$i]
            ];

            TransaksiPemusnahan::create($data[$i]);
            Asset::find($request->asset[$i])->update(['status_aset'=>'Proses Pemusnahan']);
        }

        if(request('type'))
        {
            return back();
        }

        return response()->json(['status'=>'success','message'=>'Berhasil menambahkan  pemusnahan']);

    }
    public function destroy(Request $request)
    {
        TransaksiPemusnahan::find($request->id_transaksi)->delete();
        Asset::find($request->id_asset)->update(['status_aset'=>'Tersedia']);
        return redirect('asset/pemusnahan/'.$request->id_pemusnahan);
    }
}