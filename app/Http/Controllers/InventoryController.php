<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_grup_aset)
    {
        $data['lokasi']=DB::table('property')->get();
        
        $data['url2']=$id_grup_aset;

        $data['grup'] = DB::table('grup_aset')->get();

        $data['nama_grup']=DB::table('grup_aset')->where('id_grup_aset',$id_grup_aset)->first();

        $data['asset']= DB::table('inventory')->where('inventory.id_grup_aset',$id_grup_aset)->join('property','inventory.kode_property','=','property.kode_property')->join('transaksi_mutasi_inventory','inventory.kode_inventory','=','transaksi_mutasi_inventory.kode_inventory')->get();

        $data['id_mutasi']=DB::table('mutasi')->orderBy('id_mutasi','DESC')->limit(1)->first();

        return view('inventory',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_grup_aset)
    {
        $data['lokasi']=DB::table('property')->get();
        $data['nama_grup']=DB::table('grup_aset')->where('id_grup_aset',$id_grup_aset)->first();
        return view('createinventory',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
            'kode_inventory'=>$request->kode_inventory,
            'nama_inventory'=>$request->nama_inventory,
            'harga_satuan'=>$request->harga_satuan,
            'id_grup_aset'=>$request->id_grup_aset,
            'kode_property'=>$request->lokasi,
            'id_user'=>1,
            'kondisi'=>$request->kondisi,
            'keterangan'=>$request->keterangan,
            'tgl_input'=>date('d/m/Y'),
            'satuan'=>$request->satuan,
            'status_mutasi'=>0
        ];

        DB::table('inventory')->insert($data);
        return redirect('inventory/'.$request->id_grup_aset);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_grup_aset, $kode_inventory)
    {
        $data['lokasi']=DB::table('property')->get();
        $data['nama_grup']=DB::table('grup_aset')->where('id_grup_aset',$id_grup_aset)->first();
        $data['inventory']=DB::table('inventory')->where('kode_inventory',$kode_inventory)->first();
        return view('showinventory',$data);
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
            'nama_inventory'=>$request->nama_inventory,
            'harga_satuan'=>$request->harga_satuan,
            'id_grup_aset'=>$request->id_grup_aset,
            'kode_property'=>$request->lokasi,
            'id_user'=>1,
            'kondisi'=>$request->kondisi,
            'keterangan'=>$request->keterangan,
            'tgl_input'=>date('d/m/Y'),
            'satuan'=>$request->satuan
        ];

        DB::table('inventory')->where('kode_inventory',$request->kode_inventory)->update($data);
        return redirect('inventory/show/'.$request->id_grup_aset.'/'.$request->kode_inventory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        DB::table('inventory')->where('kode_inventory',$id->kode_inventory)->delete();

        return redirect('inventory/'.$id->id_grup_aset);
    }

    public function Allinventory()
    {
        return DB::table('inventory')->get()->where('status_mutasi',0);
    }
}
