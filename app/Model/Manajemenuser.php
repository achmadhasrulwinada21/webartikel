<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manajemenuser extends Model
{
     protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password','jabatan',
    ];
}
