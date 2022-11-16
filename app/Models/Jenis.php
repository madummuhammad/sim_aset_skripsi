<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenis extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="jenis_asset";
    protected $primaryKey="id_jenis_asset";
    public $incrementing = false;
    protected $guarded=[];
}