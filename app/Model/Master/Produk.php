<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['nama','foto','ket','status','link'];
}
