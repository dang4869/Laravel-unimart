<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    //
    protected $table = 'posts_category';
    protected $fillable = ['category_post'];

    function posts(){
        return $this->hasMany('App\Post');
    }
}
