<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lokasi;
use App\Models\Mutasi;
use App\Models\TransaksiMutasi;
use PDF;

class LaporanmutasiController extends Controller
{
    public function index()
    {
        $data['lokasi']=Lokasi::all();
        $data['mutasi']=Mutasi::with('lokasi')->get();
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
        } else {
            DB::table('mutasi')->where('id_mutasi',$id_mutasi)->update(['status_mutasi'=>'Proses Pengajuan']);
            foreach ($asset as $key => $value) {
                DB::table('asset')->where('id_asset',$value->id_asset)->update(['status_aset'=>'Proses Mutasi','kode_lokasi'=>$value->kode_lokasi_sebelumnya]);
            }
        }

        return redirect('laporan/mutasi');
    }

    public function pdf($id_mutasi)
    {
        $data['lokasi']=Loksai::get();

        $data['mutasi']=DB::table('mutasi')->join('lokasi','mutasi.lokasi','=','lokasi.kode_lokasi')->join('users','mutasi.penanggung_jawab','=','users.id_user')->where('id_mutasi',$id_mutasi)->first();
        // $data['mutasi']=DB::table('mutasi')->where('id_mutasi',$id_mutasi)->join('lokasi','mutasi.lokasi','=','lokasi.kode_lokasi')->first();

        $data['asset']= DB::table('transaksi_mutasi')->join('asset','transaksi_mutasi.id_asset','=','asset.id_asset')->join('lokasi','asset.kode_lokasi','=','lokasi.kode_lokasi')->where('id_mutasi',$id_mutasi)->get();

        $data['inventory']=AssetController::Allasset();

        // return view('laporanmutasipdf',$data);

        $pdf = PDF::loadview('laporanmutasipdf',$data);
        return $pdf->download('laporan-mutasi.pdf');
    }

    public function destroy($id)
    {
        //
    }
}