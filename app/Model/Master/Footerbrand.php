<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Footerbrand extends Model
{
    protected $table = 'footer_brand';
    protected $fillable = ['nama','foto','ket','status','link','alt_teks'];
}
