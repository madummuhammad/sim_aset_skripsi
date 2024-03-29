<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count=Kategori::withTrashed()->count();
        $jml=$count+1;
        $data['id_kategori']='KTG-'.$jml;
        $data['kategori']=Kategori::orderBy('created_at','ASC')->get();

        return view('kategori',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data=[
            'id_kategori_asset'=>$request->id_kategori,
            'nama_kategori'=>$request->nama_kategori
        ];

        $message=[
            'id_kategori_asset.required'=>'Id kategori tidak boleh kosong',
            'nama_kategori.required'=>'Nama kategori tidak boleh kosong'
        ];

        $validation=Validator::make($data,[
            'id_kategori_asset'=>'required',
            'nama_kategori'=>'required'
        ],$message);

        if($validation->fails())
        {
            return back()->withErrors($validation);
        }
        Kategori::create($data);
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        $data=[
            'nama_kategori'=>$request->nama_kategori
        ];

        $dataValidation=[
            'id_kategori'=>$request->id_kategori,
            'nama_kategori'=>$request->nama_kategori
        ];

        $message=[
            'id_kategori.required'=>'Id kategori tidak boleh kosong',
            'nama_kategori.required'=>'Nama kategori tidak boleh kosong'
        ];

        $validation=Validator::make($dataValidation,[
            'id_kategori'=>'required',
            'nama_kategori'=>'required'
        ],$message);

        if($validation->fails())
        {
            return back()->withErrors($validation);
        }

        Kategori::find($request->id_kategori)->update($data);

        return redirect('kategori');
    }

    public function destroy(Request $request)
    {
        Kategori::find($request->id_kategori)->delete();
        return redirect('kategori');
    }
}