<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $fillable = ['judul','isi_artikel','foto','id_kategori','keyword','file_artikel'];

     public function kategori(){
    	return $this->hasMany('App\Model\Kategori');
    }
}
