<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemusnahan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="pemusnahan";
    protected $primaryKey="id_pemusnahan";
    public $incrementing=false;

    public $guarded=[];

    public function users(){
        return $this->hasMany(user::class,'id_user','penanggung_jawab');
    }

    public function lokasi()
    {
        return $this->hasMany(lokasi::class,'kode_lokasi','kode_lokasi');
    }

}
