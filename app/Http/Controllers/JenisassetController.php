<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisassetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_jenis_asset=DB::table('jenis_asset')->orderBy('id_jenis_asset','DESC')->limit(1)->first();
        if ($id_jenis_asset !==NULL) {
            $a=preg_replace("/JNS-/", "", $id_jenis_asset->id_jenis_asset)+1;
            $data['id_jenis_asset']='JNS-'.$a;
        } else {
            $data['id_jenis_asset']='JNS-1';
        }
        $data['jenis_asset']=DB::table('jenis_asset')->get();
        return view('jenisasset',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'id_jenis_asset'=>$request->id_jenis,
            'nama_jenis'=>$request->nama_jenis
        ];

        DB::table('jenis_asset')->insert($data);

        return redirect('jenis_asset');
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
            'nama_jenis'=>$request->nama_jenis
        ];

        DB::table('jenis_asset')->where('id_jenis_asset',$request->id_jenis)->update($data);

        return redirect('jenis_asset');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('jenis_asset')->where('id_jenis_asset',$request->id_jenis)->delete();
        return redirect('jenis_asset');
    }
}
