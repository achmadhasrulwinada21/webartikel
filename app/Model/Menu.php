<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'tabel_menu';
    protected $fillable = ['link','icon','childjudul','id_jdl'];
}
