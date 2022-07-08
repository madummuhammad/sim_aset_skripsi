<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['hak_akses']=DB::table('hak_akses')->get();
        $data['user']=DB::table('users')->join('hak_akses','users.id_hak_akses','=','hak_akses.id_hak_akses')->get();
        return view('user',$data);
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
        $password=Hash::make($request->password);
        $data=[
            'nama_user'=>$request->nama_user,
            'username'=>$request->username,
            'password'=>$password,
            'email'=>$request->email,
            'telepon'=>$request->telepon,
            'id_hak_akses'=>$request->id_hak_akses,
            'status'=>'aktif',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];

        DB::table('users')->insert($data);

        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('showuser');
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
        $id_user=$request->id_user;
        $username=$request->username;
        $email=$request->email;
        $nama_user=$request->nama_user;
        $telepon=$request->telepon;
        $halaman=$request->halaman;

        $data=[
            'username'=>$username,
            'email'=>$email,
            'nama_user'=>$nama_user,
            'telepon'=>$telepon,
            'updated_at'=>date('Y-m-d H:i:s')
        ];

        DB::table('users')->where('id_user',$id_user)->update($data);

        return redirect('user/profile');
        
    }

    public function edit_user(Request $request)
    {
        $id_user=$request->id_user;
        $username=$request->username;
        $email=$request->email;
        $nama_user=$request->nama_user;
        $telepon=$request->telepon;
        $halaman=$request->halaman;

        $data=[
            'username'=>$username,
            'email'=>$email,
            'nama_user'=>$nama_user,
            'telepon'=>$telepon,
            'updated_at'=>date('Y-m-d H:i:s')
        ];

        DB::table('users')->where('id_user',$id_user)->update($data);

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
