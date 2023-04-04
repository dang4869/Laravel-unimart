<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable = ['product_name','price','thumbnail','product_amout','product_color_id','product_status','product_desc','product_detail','category_product_id','user_id','slug','properties'];

    function category_product(){
        return $this->belongsTo('App\CategoryProduct');
    }
    function imageUrl(){
        return 'https://localhost/unimart/'.$this->thumbnail;
    }
    function user(){
        return $this->belongsTo('App\User');
    }
    function product_color(){
        return $this->hasMany('App\ProductColor');
    }
}
