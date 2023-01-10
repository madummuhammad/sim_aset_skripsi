<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lokasi;
use App\Models\Mutasi;
use App\Models\User;
use App\Models\TransaksiMutasi;
use PDF;

class LaporanmutasiController extends Controller
{
    public function index()
    {
        $data['lokasi']=Lokasi::all();
        $data['mutasi']=Mutasi::with('lokasi')->where('status_mutasi','!=','Proses Mutasi')->get();
        return view('laporanmutasi',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id_mutasi)
    {
       $data['lokasi']=Lokasi::all();
       $data['mutasi']=Mutasi::with('lokasi')->with('users')->where('id_mutasi',$id_mutasi)->first();
       $data['asset']=TransaksiMutasi::with('asset')->with('lokasi')->where('id_mutasi',$id_mutasi)->get();
       $data['inventory']=AssetController::Allasset();
       return view('showlaporanmutasi',$data);
   }

   public function edit($id)
   {
        //
   }

   public function update(Request $request)
   {
    $id_mutasi=$request->id_mutasi;
    $status=$request->status;
    $asset=TransaksiMutasi::where('id_mutasi',$id_mutasi)->get();
    $lokasi_sebelumnya=TransaksiMutasi::where('id_mutasi',$id_mutasi)->first();
    $lokasi_mutasi=$request->kode_lokasi;
    $jml=count($asset);
    if ($status=='Proses Pengajuan') {
        Mutasi::find($id_mutasi)->update(['status_mutasi'=>'Sudah Disetujui']);
        NotifikasiController::store_notifikasi_persetujuan_mutasi($id_mutasi);
        foreach ($asset as $key => $value) {
            DB::table('asset')->where('id_asset',$value->id_asset)->update(['status_aset'=>'Tersedia','kode_lokasi'=>$request->kode_lokasi]);
        }
    }

    if ($status=='Ditolak') {
        Mutasi::find($id_mutasi)->update(['status_mutasi'=>'Ditolak']);
        // NotifikasiController::store_notifikasi_persetujuan_mutasi($id_mutasi);
        foreach ($asset as $key => $value) {
            DB::table('asset')->where('id_asset',$value->id_asset)->update(['status_aset'=>'Tersedia','kode_lokasi'=>$request->kode_lokasi]);
        }
    }

    return redirect('laporan/mutasi');
}

public function pdf($id_mutasi)
{
    $data['lokasi']=Lokasi::get();
    $data['mutasi']=Mutasi::with('lokasi','users')->where('id_mutasi',$id_mutasi)->first();
    $data['asset']=TransaksiMutasi::with('asset','lokasi','asset.lokasi')->where('id_mutasi',$id_mutasi)->get();


    $data['inventory']=AssetController::Allasset();

        // return $data['mutasi']->lokasi;

        // return view('laporanmutasipdf',$data);
    $user=User::where('id_hak_akses',3)->first();

    $data['ttd']=$user->ttd;

    $pdf = PDF::loadview('laporanmutasipdf',$data);
    return $pdf->download('berita-acara-mutasi.pdf');
}

public function destroy($id)
{
        //
}
}