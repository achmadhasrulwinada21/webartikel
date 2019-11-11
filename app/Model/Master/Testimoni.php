<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimoni';
    protected $fillable = ['nama','foto','ket','status','alt_teks'];
}
