<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPemusnahan extends Model
{
    use HasFactory;

    protected $table="transaksi_pemusnahan";
    protected $primaryKey="id_transaksi";

    public $guarded=[];

    
    public function lokasi()
    {
        return $this->hasMany(Lokasi::class, 'kode_lokasi', 'kode_lokasi');
    }


    public function asset()
    {
        return $this->hasMany(Asset::class, 'id_asset', 'id_asset');
    }
}