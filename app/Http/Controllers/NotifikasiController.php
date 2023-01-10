<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiPemusnahan;
use App\Models\TransaksiMutasi;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        $hak_akses=auth()->user()->id_hak_akses;

        if($hak_akses==3)
        {
            $notifikasi=Notifikasi::with('mutasi','pemusnahan')->where('jenis_notifikasi','Pengajuan Mutasi')->orWhere('jenis_notifikasi','Pengajuan Pemusnahan')->orderBy('id','DESC')->get();
        }

        if($hak_akses==1 OR $hak_akses==2)
        {    
            $notifikasi=Notifikasi::with('mutasi','pemusnahan')->where('jenis_notifikasi', 'Persetujuan Mutasi')->orWhere('jenis_notifikasi', 'Persetujuan Pemusnahan')->orWhere('jenis_notifikasi','Pengecekan Kondisi')->orWhere('jenis_notifikasi','Penolakan Mutasi')->orWhere('jenis_notifikasi','Penolakan Pemusnahan')->orderBy('id','DESC')->get();
        }

        $data['notifikasi']=$notifikasi;
        return view('notifikasi',$data);

    }
    public function update(Request $request)
    {
        $hak_akses=auth()->user()->id_hak_akses;
        DB::table('notifikasi')->where('id',$request->id_notifikasi)->update(['read_at'=>date('Y-m-d H:i:s')]);

        $notifikasi=Notifikasi::where('id',request('id_notifikasi'))->first();

        if($notifikasi->mutasi!==null)
        {
            if($hak_akses==3)
            {

                return redirect('laporan/mutasi/'.$notifikasi->id_mutasi);
            } else {
                return redirect('asset/mutasi/'.$notifikasi->id_mutasi);
            }
        }

        if($notifikasi->pemusnahan!==null)
        {
            if($hak_akses==3)
            {

                return redirect('laporan/pemusnahan/'.$notifikasi->id_pemusnahan);
            } else {
                return redirect('asset/pemusnahan/'.$notifikasi->id_pemusnahan);
            }
        }

        if($notifikasi->mutasi ==null AND $notifikasi->pemusnahan==null)
        {
            return redirect('asset/detil/'.$notifikasi->id_asset);
        }
    }

    public function store_notifikasi_pengajuan_mutasi($id_mutasi)
    {
       $transaksi_mutasi=TransaksiMutasi::where('id_mutasi',$id_mutasi)->get();

       foreach ($transaksi_mutasi as $key => $value) {
        $datanotifikiasi=[
            'jenis_notifikasi'=>'Pengajuan Mutasi',
            'keterangan'=>'Ada pengajuan Mutasi',
            'id_asset'=>$value->id_asset,
            'id_mutasi'=>$id_mutasi,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        Notifikasi::create($datanotifikiasi);
    }
}

public function store_notifikasi_persetujuan_mutasi($id_mutasi)
{

    $transaksi_mutasi=DB::table('transaksi_mutasi')->where('id_mutasi',$id_mutasi)->get();

    foreach ($transaksi_mutasi as $key => $value) {
        $datanotifikiasi=[
            'jenis_notifikasi'=>'Persetujuan Mutasi',
            'keterangan'=>'Pengajuan Mutasi Disetujui',
            'id_asset'=>$value->id_asset,
            'id_mutasi'=>$id_mutasi,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        DB::table('notifikasi')->insert($datanotifikiasi);
    }
}

public function penolakan_mutasi($id_mutasi)
{
    $transaksi_mutasi=DB::table('transaksi_mutasi')->where('id_mutasi',$id_mutasi)->get();

    foreach ($transaksi_mutasi as $key => $value) {
        $datanotifikiasi=[
            'jenis_notifikasi'=>'Penolakan Mutasi',
            'keterangan'=>'Pengajuan Mutasi Ditolak',
            'id_asset'=>$value->id_asset,
            'id_mutasi'=>$id_mutasi,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        DB::table('notifikasi')->insert($datanotifikiasi);
    }
}

public function store_notifikasi_pengajuan_pemusnahan($id_pemusnahan)
{

    $transaksi_pemusnahan=DB::table('transaksi_pemusnahan')->where('id_pemusnahan',$id_pemusnahan)->get();

    foreach ($transaksi_pemusnahan as $key => $value) {
        $datanotifikiasi=[
            'jenis_notifikasi'=>'Pengajuan Pemusnahan',
            'keterangan'=>'Ada pengajuan pemusnahan',
            'id_asset'=>$value->id_asset,
            'id_pemusnahan'=>$id_pemusnahan,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        DB::table('notifikasi')->insert($datanotifikiasi);
    }
}

public function store_notifikasi_persetujuan_pemusnahan($id_pemusnahan)
{

    $transaksi_pemusnahan=TransaksiPemusnahan::where('id_pemusnahan',$id_pemusnahan)->get();

    foreach ($transaksi_pemusnahan as $key => $value) {
        $datanotifikiasi=[
            'jenis_notifikasi'=>'Persetujuan Pemusnahan',
            'keterangan'=>'Pengajuan Pemusnahan Disetujui',
            'id_asset'=>$value->id_asset,
            'id_pemusnahan'=>$id_pemusnahan,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        DB::table('notifikasi')->insert($datanotifikiasi);
    }
}

public function penolakan_pemusnahan($id_pemusnahan)
{
    $transaksi_pemusnahan=TransaksiPemusnahan::where('id_pemusnahan',$id_pemusnahan)->get();

    foreach ($transaksi_pemusnahan as $key => $value) {
        $datanotifikiasi=[
            'jenis_notifikasi'=>'Penolakan Pemusnahan',
            'keterangan'=>'Pengajuan Pemusnahan Ditolak',
            'id_asset'=>$value->id_asset,
            'id_pemusnahan'=>$id_pemusnahan,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        DB::table('notifikasi')->insert($datanotifikiasi);
    }
}
}