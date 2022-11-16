<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notifikasi;


function pengajuan_mutasi(){
    return DB::table('notifikasi')->where('read_at', null)->where('jenis_notifikasi', 'Pengajuan Mutasi')->count();
}

function pengecekan_kondisi(){
    return DB::table('notifikasi')->where('read_at', null)->where('jenis_notifikasi', 'Pengecekan Kondisi')->count();
}

function pengajuan_pemusnahan(){
    return DB::table('notifikasi')->where('read_at', null)->where('jenis_notifikasi', 'Pengajuan Pemusnahan')->count();
}

function persetujuan_mutasi(){
    return DB::table('notifikasi')->where('read_at', null)->where('jenis_notifikasi', 'Persetujuan Mutasi')->count();
}

function persetujuan_pemusnahan(){
    return DB::table('notifikasi')->where('read_at', null)->where('jenis_notifikasi', 'Persetujuan Pemusnahan')->count();
}