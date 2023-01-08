<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemusnahan;
use App\Models\Asset;
use App\Models\BuktiPemusnahan;
use App\Models\TransaksiPemusnahan;
use App\Http\Controllers\AssetController;
use Validator;
use Storage;

class PemusnahanController extends Controller
{
    public function index()
    {
        $data['pemusnahan']=Pemusnahan::get();
        return view('pemusnahan',$data);
    }

    public function bukti($id_pemusnahan)
    {
        $data['pemusnahan']=Pemusnahan::with('users')->find($id_pemusnahan);
        $data['bukti']=BuktiPemusnahan::where('id_pemusnahan',$id_pemusnahan)->get();

        return view('buktipemusnahan',$data);
    }

    public function create_bukti(Request $request)
    {
        $foto=$_FILES['foto']['error'];
        if($foto==0)
        {
            $disk = Storage::disk('public')->put('image', $request->file('foto'));
            $url_image=asset('storage/').'/'.$disk;
            BuktiPemusnahan::create(['foto'=>$url_image,'id_pemusnahan'=>request('id_pemusnahan')]);
        }

        return back();
    }
    public function store(Request $request)
    {
        $data=[
            'id_pemusnahan'=>$request->id_pemusnahan,
            'nama'=>$request->nama,
            'penanggung_jawab'=>auth()->user()->id_user,
            'deskripsi'=>$request->deskripsi,
            'status_pemusnahan'=>"Proses pemusnahan"
        ];


        $validation=Validator::make($data,[
            'id_pemusnahan'=>'required',
            'nama'=>'required',
            'penanggung_jawab'=>'required',
            'deskripsi'=>'required',
            'status_pemusnahan'=>'required'
        ]);

        if($validation->fails())
        {
            return response()->json(['status'=>'error']);
        }


        Pemusnahan::create($data);
    }

    public function show($id_pemusnahan)
    {
        $data['pemusnahan']=Pemusnahan::with('users')->find($id_pemusnahan);
        $data['asset']=TransaksiPemusnahan::with('asset')->where('id_pemusnahan',$id_pemusnahan)->get();

        $data['inventory']=AssetController::Allasset();
        return view('showpemusnahan',$data);
    }
    public function update(Request $request)
    {
        $id_pemusnahan=$request->id_pemusnahan;
        if ($request->status==NULL) {
            $dataValidation=[
                'nama'=>$request->nama,
                'penanggung_jawab'=>auth()->user()->id_user,
                'deskripsi'=>$request->deskripsi,
                'status_pemusnahan'=>'Proses Pemusnahan'
            ];

            $validation=Validator::make($dataValidation,[
                'nama'=>'required',
                'penanggung_jawab'=>'required',
                'deskripsi'=>'required',
                'status_pemusnahan'=>'required'
            ]);

            if($validation->fails())
            {
                return back()->withErrors($validation);
            }


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