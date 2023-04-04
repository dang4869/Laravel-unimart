<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    //
    protected $table = 'product_colors';
    protected $fillable = ['name','color_code','product_id','amout'];

    function product(){
        return $this->belongsTo('App\Product');
    }
}
