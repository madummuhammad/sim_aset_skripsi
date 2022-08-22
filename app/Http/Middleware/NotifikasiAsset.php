<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifikasiAsset
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $asset=DB::table('asset')->get();
        foreach ($asset as $key => $value) {
            $awal  = date_create();
            $akhir = date_create($value->umur_akhir);
            $diff  = date_diff( $awal, $akhir );

            if ($value->status_aset=='Perlu Pengecekan') {

            } elseif($value->status_aset=='Tersedia') {
                if ($awal>=$akhir) {
                    $data=[
                        'jenis_notifikasi'=>'Pengecekan Kondisi',
                        'keterangan'=>'Umur ekonomis aset sudah habis',
                        'id_asset'=>$value->id_asset,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s')
                    ];
                    DB::table('asset')->where('id_asset',$value->id_asset)->update(['status_aset'=>'Perlu Pengecekan']);
                    DB::table('notifikasi')->insert($data);
                } else {
                  if ($diff->days <=90) {
                     $data=[
                        'jenis_notifikasi'=>'Pengecekan Kondisi',
                        'keterangan'=>'Umur ekonomis aset kurang dari 90 hari',
                        'id_asset'=>$value->id_asset,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s')
                    ];
                    DB::table('asset')->where('id_asset',$value->id_asset)->update(['status_aset'=>'Perlu Pengecekan']);
                    DB::table('notifikasi')->insert($data);
                } else {

                }
            }
        }

    }
    return $next($request);

}
}
