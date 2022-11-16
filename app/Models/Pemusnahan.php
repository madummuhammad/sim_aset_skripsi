<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemusnahan extends Model
{
    use HasFactory;

    protected $table="pemusnahan";
    protected $primaryKey="id_pemusnahan";

    public $guarded=[];

    public function users(){
        return $this->hasMany(user::class,'id_user','penanggung_jawab');
    }
}
