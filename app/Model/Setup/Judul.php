<?php

namespace App\Model\Setup;

use Illuminate\Database\Eloquent\Model;

class Judul extends Model
{
     protected $table = 'judul_menu';
    protected $fillable = ['judul','keterangan'];
}
