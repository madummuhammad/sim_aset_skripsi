<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Collection;
use PDF;
use App\Models\Mutasi;
use App\Models\Lokasi;
use App\Models\Asset;
use App\Models\Kategori;
use App\Models\Jenis;
use App\Models\Pemusnahan;

class AssetController extends Controller
{
    public function index()
    {
        $data['id_mutasi']=Mutasi::orderByDesc('id_mutasi')->limit(1)->first();
        $data['id_pemusnahan']=Pemusnahan::orderByDesc('id_pemusnahan')->limit(1)->first();
        $data['lokasi']=Lokasi::get();
        $data['asset']=Asset::with('lokasi')->get();
        return view('asset',$data);
    }

    public function create()
    {
        $data['kategori_asset']=Kategori::get();
        $data['jenis_asset']=Jenis::all();
        $data['lokasi']=Lokasi::all();
        return view('createasset',$data);
    }

    public function store(Request $request)
    {
        $id_asset=Asset::orderByDesc("id_asset")->first();
        $asset=Asset::where('id_asset','ASST_'.$request->id_kategori_asset.'_'.$request->id_jenis_asset.'_'.date('Ym'.'_0000000001'))->first();
        $pattern="/ASST+\W+KTG-+\d+\W+JNS-+\d+\W+\d+\W/";
        for ($i=0; $i < $request->jumlah ; $i++) {
            if ($asset !== NULL) {
                $a=preg_replace("/ASST_KTG-+\d_JNS-+\d_+\d+_+0+/", "", $id_asset->id_asset)+1+$i;
                $hasil='ASST_'.$request->id_kategori_asset.'_'.$request->id_jenis_asset.'_'.date('Ym').'_'.sprintf("%010d",$a);
            } else {
                $nomor=$i+1;
                $hasil='ASST_'.$request->id_kategori_asset.'_'.$request->id_jenis_asset.'_'.date('Ym').'_'.sprintf("%010d",$nomor);
            }
            $data=[
                'id_asset'=>$hasil,
                'nama_asset'=>$request->nama_asset,
                'harga_satuan'=>$request->harga_satuan,
                'kode_lokasi'=>$request->kode_lokasi,
                'id_jenis_asset'=>$request->id_jenis_asset,
                'id_kategori_asset'=>$request->id_kategori_asset,
                'id_user'=>auth()->user()->id_user,
                'kondisi'=>$request->kondisi,
                'tgl_input'=>date('d/m/Y'),
                'satuan'=>$request->satuan,
                'umur_mulai'=>$request->umur_mulai,
                'umur_akhir'=>$request->umur_akhir,
                'status_aset'=>'Tersedia'
            ];

            Asset::create($data);
        }
        return redirect('asset');

    }

    public function show($id_asset)
    {
        $data['kategori_asset']=Kategori::all();
        $data['jenis_asset']=Jenis::all();
        $data['lokasi']=Lokasi::all();
        $data['asset']=Asset::where('id_asset',$id_asset)->first();
        return view('showasset',$data);
    }

    public function edit($id_asset)
    {
        $data['kategori_asset']=Kategori::all();
        $data['jenis_asset']=Jenis::all();
        $data['lokasi']=Lokasi::all();
        $data['asset']=Asset::with('lokasi')->with('kategori')->with('jenis')->where('id_asset',$id_asset)->first();

        return view('detilasset',$data);
    }

    public function resultqr($id_asset)
    {

        $data['kategori_asset']=Kategori::all();
        $data['jenis_asset']=Jenis::all();
        $data['lokasi']=Lokasi::all();
        $data['asset']=Asset::with('lokasi')->with('kategori')->with('jenis')->where('id_asset',$id_asset)->first();
        return view('resultqr',$data);
    }

    public function update(Request $request)
    {
        $data=[
            'nama_asset'=>$request->nama_asset,
            'harga_satuan'=>$request->harga_satuan,
            'kode_lokasi'=>$request->kode_lokasi,
            'id_jenis_asset'=>$request->id_jenis_asset,
            'id_kategori_asset'=>$request->id_kategori_asset,
            'id_user'=>auth()->user()->id_user,
            'kondisi'=>$request->kondisi,
            'satuan'=>$request->satuan,
            'umur_mulai'=>$request->umur_mulai,
            'umur_akhir'=>$request->umur_akhir
        ];

        Asset::find($request->id_asset)->update($data);
        return redirect('asset');
    }

    public function destroy(Request $id)
    {
        Asset::find($id->id_asset)->forceDelete();

        return redirect('asset');
    }

    public function Allasset()
    {
        return Asset::whereNotIn('status_aset',['Proses Mutasi','Proses Pemusnahan'])->get();
    }

    public function generateqr($id_asset)
    {
     $data['kategori_asset']=Kategori::all();
        $data['jenis_asset']=Jenis::all();
        $data['lokasi']=Lokasi::all();
      $data['asset']=Asset::with('lokasi')->with('kategori')->with('jenis')->where('id_asset',$id_asset)->first();
     $data['qrcode']=QrCode::size(100)->generate(url(''));
     $pdf = PDF::loadview('generateqrasset',$data);
     return $pdf->download('QR-Code-'.$id_asset.'.pdf');
 }

 public function jml_asset()
 {
    return Asset::count();
}
}