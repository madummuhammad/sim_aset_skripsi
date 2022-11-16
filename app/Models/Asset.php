<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Asset extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='asset';
    protected $primaryKey='id_asset';
    public $incrementing=false;

    protected $guarded=[];

    public function lokasi()
    {
        return $this->hasMany(lokasi::class,'kode_lokasi','kode_lokasi');
    }
    public function kategori()
    {
        return $this->hasMany(kategori::class,'id_kategori_asset','id_kategori_asset');
    }
    public function jenis()
    {
        return $this->hasMany(jenis::class,'id_jenis_asset','id_jenis_asset');
    }

}