<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_grup_aset)
    {
        $data['url2']=$id_grup_aset;
        $data['grup'] = DB::table('grup_aset')->get();

        $data['nama_grup']=DB::table('grup_aset')->where('id_grup_aset',$id_grup_aset)->first();

        $data['asset']= DB::table('property')->where('id_grup_aset',$id_grup_aset)->get();


        return view('property',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_grup_aset)
    {
        $data['nama_grup']=DB::table('grup_aset')->where('id_grup_aset',$id_grup_aset)->first();
        return view('createproperty',$data);
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
            'kode_property'=>$request->kode_property,
            'nama_property'=>$request->nama_property,
            'harga_satuan'=>$request->harga_satuan,
            'id_grup_aset'=>$request->id_grup_aset,
            'id_user'=>1,
            'kondisi'=>$request->kondisi,
            'keterangan'=>$request->keterangan,
            'tgl_input'=>date('d/m/Y'),
            'satuan'=>$request->satuan
        ];

        DB::table('property')->insert($data);
        return redirect('property/'.$request->id_grup_aset);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_grup_aset, $kode_property)
    {

        $data['nama_grup']=DB::table('grup_aset')->where('id_grup_aset',$id_grup_aset)->first();
        $data['property']=DB::table('property')->where('kode_property',$kode_property)->first();
        return view('showproperty',$data);
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
            'nama_property'=>$request->nama_property,
            'harga_satuan'=>$request->harga_satuan,
            'id_grup_aset'=>$request->id_grup_aset,
            'id_user'=>1,
            'kondisi'=>$request->kondisi,
            'keterangan'=>$request->keterangan,
            'tgl_input'=>date('d/m/Y'),
            'satuan'=>$request->satuan
        ];

        DB::table('property')->where('kode_property',$request->kode_property)->update($data);
        return redirect('property/show/'.$request->id_grup_aset.'/'.$request->kode_property);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        DB::table('property')->where('kode_property',$id->kode_property)->delete();

        return redirect('property/'.$id->id_grup_aset);
    }
}
