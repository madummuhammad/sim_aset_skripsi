<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lokasi;
use Validator;

class LokasiController extends Controller
{
    public function index()
    {
        $count=Lokasi::withTrashed()->count();
        $jml=$count+1;
        $data['kode_lokasi']='LKS-'.$jml;
        $data['lokasi']=Lokasi::orderBy('created_at','ASC')->get();
        return view('lokasi',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data=[
            'kode_lokasi'=>$request->kode_lokasi,
            'nama_lokasi'=>$request->nama_lokasi
        ];

        $message=[
            'kode_lokasi.required'=>'Kode lokasi asset tidak boleh kosong',
            'nama_lokasi.required'=>'Nama lokasi asset tidak boleh kosong'
        ];

        $validation=Validator::make($data,[
            'kode_lokasi'=>'required',
            'nama_lokasi'=>'required'
        ],$message);

        if($validation->fails())
        {
            return back()->withErrors($validation);
        }

        Lokasi::create($data);

        return redirect('lokasi');
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
            'nama_lokasi'=>$request->nama_lokasi
        ];

        $dataValidation=[
            'kode_lokasi'=>$request->kode_lokasi,
            'nama_lokasi'=>$request->nama_lokasi
        ];


        $message=[
            'kode_lokasi.required'=>'Kode lokasi asset tidak boleh kosong',
            'nama_lokasi.required'=>'Nama lokasi asset tidak boleh kosong'
        ];

        $validation=Validator::make($dataValidation,[
            'kode_lokasi'=>'required',
            'nama_lokasi'=>'required'
        ],$message);

        if($validation->fails())
        {
            return back()->withErrors($validation);
        }

        Lokasi::find($request->kode_lokasi)->update($data);
        return redirect('lokasi');
    }

    public function destroy(Request $request)
    {
        Lokasi::find($request->kode_lokasi)->delete();
        return redirect('lokasi');
    }
}