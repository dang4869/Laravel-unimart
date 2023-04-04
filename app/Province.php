<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table = 'province';
    function order(){
            return $this->hasMany('App\Order');
    }
}
