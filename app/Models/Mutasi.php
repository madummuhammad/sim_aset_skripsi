<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $table="mutasi";
    protected $primaryKey="id_mutasi";

    protected $guarded=[];

    public function lokasi()
    {
        return $this->hasMany(lokasi::class,'kode_lokasi','kode_lokasi');
    }

    public function users()
    {
        return $this->hasMany(user::class,'id_user','penanggung_jawab');
    }
}