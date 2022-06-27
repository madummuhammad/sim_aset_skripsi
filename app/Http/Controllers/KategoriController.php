<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_kategori=DB::table('kategori_asset')->orderBy('id_kategori_asset','DESC')->limit(1)->first();
        if ($id_kategori !==NULL) {
            $a=preg_replace("/KTG-/", "", $id_kategori->id_kategori_asset)+1;
            $data['id_kategori']='KTG-'.$a;
        } else {
            $data['id_kategori']='KTG-1';
        }
        $data['kategori']=DB::table('kategori_asset')->get();

        // var_dump($id_kategori->id_kategori_asset);
        return view('kategori',$data);
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
            'id_kategori_asset'=>$request->id_kategori,
            'nama_kategori'=>$request->nama_kategori
        ];

        DB::table('kategori_asset')->insert($data);

        return redirect('kategori');
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
            'nama_kategori'=>$request->nama_kategori
        ];

        DB::table('kategori_asset')->where('id_kategori_asset',$request->id_kategori)->update($data);

        return redirect('kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('kategori_asset')->where('id_kategori_asset',$request->id_kategori)->delete();
        return redirect('kategori');
    }
}
