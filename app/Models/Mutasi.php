<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mutasi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="mutasi";
    protected $primaryKey="id_mutasi";
    public $incrementing=false;

    protected $guarded=[];

    public function lokasi()
    {
        return $this->hasMany(Lokasi::class,'kode_lokasi','kode_lokasi');
    }

    public function users()
    {
        return $this->hasMany(User::class,'id_user','penanggung_jawab');
    }
}