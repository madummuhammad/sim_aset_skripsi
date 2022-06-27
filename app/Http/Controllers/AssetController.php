<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['id_mutasi']=DB::table('mutasi')->orderBy('id_mutasi','DESC')->limit(1)->first();
        $data['lokasi']=DB::table('lokasi')->get();
        $data['asset']=DB::table('asset')->join('lokasi','asset.kode_lokasi','=','lokasi.kode_lokasi')->get();
        // $data['asset']=DB::table('asset')->join('lokasi','asset.kode_lokasi','=','lokasi.kode_lokasi')->join('transaksi_mutasi','asset.id_asset','=','transaksi_mutasi.id_asset')->get();
        return view('asset',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kategori_asset']=DB::table('kategori_asset')->get();
        $data['jenis_asset']=DB::table('jenis_asset')->get();
        $data['lokasi']=DB::table('lokasi')->get();
        return view('createasset',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_asset=DB::table('asset')->orderBy('id_asset','DESC')->first();
        $pattern="/ASST+\W+KTG-+\d+\W+JNS-+\d+\W+\d+\W/";
        for ($i=0; $i < $request->jumlah ; $i++) {
            if ($id_asset !== NULL) {
                $a=preg_replace("/ASST+\W+KTG-+\d+\W+JNS-+\d+\W+\d+\W/", "", $id_asset->id_asset)+1+$i;
                $hasil='ASST/'.$request->id_kategori_asset.'/'.$request->id_jenis_asset.'/'.date('Ym').'/'.sprintf("%010d",$a);
            } else {
                $nomor=$i+1;
                $hasil='ASST/'.$request->id_kategori_asset.'/'.$request->id_jenis_asset.'/'.date('Ym').'/'.sprintf("%010d",$nomor);
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
                'status_mutasi'=>0
            ];

            // var_dump($data);echo "<br><br>";
            DB::table('asset')->insert($data);
        }
        return redirect('asset');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_asset)
    {
        $data['kategori_asset']=DB::table('kategori_asset')->get();
        $data['jenis_asset']=DB::table('jenis_asset')->get();
        $data['lokasi']=DB::table('lokasi')->get();
        $data['asset']=DB::table('asset')->where('id_asset',$id_asset)->first();
        return view('showasset',$data);
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
        $data=[
            'nama_asset'=>$request->nama_asset,
            'harga_satuan'=>$request->harga_satuan,
            'kode_lokasi'=>$request->kode_lokasi,
            'id_jenis_asset'=>$request->id_jenis_asset,
            'id_kategori_asset'=>$request->id_kategori_asset,
            'id_user'=>auth()->user()->id_user,
            'kondisi'=>$request->kondisi,
            'satuan'=>$request->satuan,
            'status_mutasi'=>0
        ];

        DB::table('asset')->where('id_asset',$request->id_asset)->update($data);
        return redirect('asset');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        DB::table('asset')->where('id_asset',$id->id_asset)->delete();

        return redirect('asset');
    }

    public function Allasset()
    {
        return DB::table('asset')->get()->where('status_mutasi',0);
    }
}
