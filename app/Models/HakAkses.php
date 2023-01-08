<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HakAkses extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="hak_akses";
    protected $primaryKey="id_hak_akses";
    public $incrementing = false;
    protected $guarded=[];
}