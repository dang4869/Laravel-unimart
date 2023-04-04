<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    protected $table = 'gallerys';
    protected $fillable = ['gallery_name', 'gallery_image', 'product_id'];
}
