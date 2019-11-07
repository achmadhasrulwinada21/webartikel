<?php

namespace App\Model\File;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category_file';
    protected $fillable = ['kategori'];
}
