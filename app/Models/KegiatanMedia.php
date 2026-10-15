<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanMedia extends Model
{
    protected $fillable = ['kegiatan_id', 'type', 'file', 'poster'];
}
