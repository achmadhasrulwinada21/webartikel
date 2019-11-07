<?php

namespace App\Model\File;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
     protected $table = 'file';
     protected $fillable = ['foto','ket','id_kategori'];
}
