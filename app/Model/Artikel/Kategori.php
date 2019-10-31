<?php

namespace App\Model\Artikel;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
     protected $table = 'kategori';
    protected $fillable = ['kategori'];

     public function artikel(){
    	return $this->belongsTo('App\Model\Artikel\Artikel');
    }
}
