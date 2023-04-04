<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';
    protected $fillable = ['order_code','order_name','email','address','phone','notes','order_status','payment','province','district','wards'];
    function provinces(){
        return $this->belongsTo('App\Province');
    }
    function order_detail(){
        return $this->hasOne('App\Order_detail');
    }
}
