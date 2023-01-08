<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMutasi extends Model
{
    use HasFactory;
    protected $table="transaksi_mutasi";
    protected $primaryKey="id_transaksi";
    public $guarded=[];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'kode_lokasi_sebelumnya', 'kode_lokasi');
    }

    public function asset()
    {
        return $this->hasMany(Asset::class, 'id_asset', 'id_asset');
    }
}