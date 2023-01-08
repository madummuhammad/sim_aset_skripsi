<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemusnahan;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Asset;
use App\Models\BuktiPemusnahan;
use App\Models\TransaksiPemusnahan;
use PDF;

class LaporanpemusnahanController extends Controller
{
    public function index()
    {
        $data['lokasi']=Lokasi::all();
        $data['pemusnahan']=Pemusnahan::with('lokasi')->where('status_pemusnahan','!=','Proses Pemusnahan')->get();
        return view('laporanpemusnahan',$data);
    }

    public function show($id_pemusnahan)
    {
     $data['lokasi']=Lokasi::all();
     $data['pemusnahan']=Pemusnahan::with('lokasi')->with('users')->where('id_pemusnahan',$id_pemusnahan)->first();
     $data['asset']=TransaksiPemusnahan::with('asset')->with('lokasi')->where('id_pemusnahan',$id_pemusnahan)->get();
     $data['bukti']=BuktiPemusnahan::where('id_pemusnahan',$id_pemusnahan)->get();
     $data['inventory']=AssetController::Allasset();
     return view('showlaporanpemusnahan',$data);
 }

 public function konfirmasi_bukti()
 {
    $id_pemusnahan=request('id_pemusnahan');
    Pemusnahan::where("id_pemusnahan",$id_pemusnahan)->update(['status_pemusnahan'=>'Sudah Dilaksanakan']);
    $transaksi_pemusnahan=TransaksiPemusnahan::where('id_pemusnahan',$id_pemusnahan)->get();

    foreach ($transaksi_pemusnahan as $key => $value) {
        Asset::where('id_asset',$value->id_asset)->update(['status_aset'=>'Dimusnahkan']);
    }
    return back();
}

public function update(Request $request)
{
    $id_pemusnahan=$request->id_pemusnahan;
    $status=$request->status;
    $asset=TransaksiPemusnahan::where('id_pemusnahan',$id_pemusnahan)->get();
    $jml=count($asset);
    if ($status=='Proses Pengajuan') {
        Pemusnahan::find($id_pemusnahan)->update(['status_pemusnahan'=>'Sudah Disetujui']);
        NotifikasiController::store_notifikasi_persetujuan_pemusnahan($id_pemusnahan);
        foreach ($asset as $key => $value) {
            Asset::where('id_asset',$value->id_asset)->update(['status_aset'=>'Proses Pemusnahan']);
        }
    } else {
        Pemusnahan::where('id_pemusnahan',$id_pemusnahan)->update(['status_pemusnahan'=>'Proses Pengajuan']);
        foreach ($asset as $key => $value) {
            Asset::where('id_asset',$value->id_asset)->update(['status_aset'=>'Proses Pemusnahan']);
        }
    }
    return redirect('laporan/pemusnahan');
}

public function pdf($id_pemusnahan)
{
    $data['lokasi']=Lokasi::get();
    $data['pemusnahan']=Pemusnahan::with('users')->where('id_pemusnahan',$id_pemusnahan)->first();
    $data['asset']=TransaksiPemusnahan::with('asset','asset.lokasi')->where('id_pemusnahan',$id_pemusnahan)->get();
    $data['inventory']=AssetController::Allasset();
    $user=User::where('id_hak_akses',3)->first();
    $data['ttd']=$user->ttd;
    $pdf = PDF::loadview('laporanpemusnahanpdf',$data);
    return $pdf->download('berita-acara-pemusnahan.pdf');
}
}
