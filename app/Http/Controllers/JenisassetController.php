<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jenis;
use Validator;

class JenisassetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_jenis_asset=Jenis::orderByDesc('id_jenis_asset')->withTrashed()->limit(1)->first();
        if ($id_jenis_asset !==NULL) {
            $a=preg_replace("/JNS-/", "", $id_jenis_asset->id_jenis_asset)+1;
            $data['id_jenis_asset']='JNS-'.$a;
        } else {
            $data['id_jenis_asset']='JNS-1';
        }
        $data['jenis_asset']=Jenis::all();
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


        $message=[
            'id_jenis_asset.required'=>'Id jenis asset tidak boleh kosong',
            'nama_jenis.required'=>'Nama jenis asset tidak boleh kosong'
        ];

        $validation=Validator::make($data,[
            'id_jenis_asset'=>'required',
            'nama_jenis'=>'required'
        ],$message);

        if($validation->fails())
        {
            return back()->withErrors($validation);
        }

        Jenis::create($data);

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
            'nama_jenis'=>$request->nama_jenis
        ];

        $dataValidation=[
            'id_jenis_asset'=>$request->id_jenis,
            'nama_jenis'=>$request->nama_jenis
        ];


        $message=[
            'id_jenis_asset.required'=>'Id jenis asset tidak boleh kosong',
            'nama_jenis.required'=>'Nama jenis asset tidak boleh kosong'
        ];

        $validation=Validator::make($dataValidation,[
            'id_jenis_asset'=>'required',
            'nama_jenis'=>'required'
        ],$message);

        if($validation->fails())
        {
            return back()->withErrors($validation);
        }
        Jenis::find($request->id_jenis)->update($data);
        return redirect('jenis_asset');
    }

    public function destroy(Request $request)
    {
        Jenis::find($request->id_jenis)->delete();
        return redirect('jenis_asset');
    }
}