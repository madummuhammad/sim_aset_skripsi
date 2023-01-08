<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table='notifikasi';
    protected $guarded=[];

    public function asset()
    {
        return $this->belongsTo('App\Models\Asset','id_asset','id_asset');
    }

    public function mutasi()
    {
        return $this->belongsTo(Mutasi::class,'id_mutasi','id_mutasi');
    }
    public function pemusnahan()
    {
        return $this->belongsTo(Pemusnahan::class,'id_pemusnahan','id_pemusnahan');
    }
}