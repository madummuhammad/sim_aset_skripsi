<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $kode_lokasi=DB::table('lokasi')->orderBy('kode_lokasi','DESC')->limit(1)->first();
       if ($kode_lokasi !==NULL) {
        $a=preg_replace("/LKS-/", "", $kode_lokasi->kode_lokasi)+1;
        $data['kode_lokasi']='LKS-'.$a;
    } else {
        $data['kode_lokasi']='LKS-1';
    }
    $data['lokasi']=DB::table('lokasi')->get();
    return view('lokasi',$data);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'kode_lokasi'=>$request->kode_lokasi,
            'nama_lokasi'=>$request->nama_lokasi
        ];

        DB::table('lokasi')->insert($data);

        return redirect('lokasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'nama_lokasi'=>$request->nama_lokasi
        ];

        DB::table('lokasi')->where('kode_lokasi',$request->kode_lokasi)->update($data);

        return redirect('lokasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('lokasi')->where('kode_lokasi',$request->kode_lokasi)->delete();
        return redirect('lokasi');
    }
}
