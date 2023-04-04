<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'category_post_id', 'votes', 'thumbnail','slug'];

    function category_post(){
        return $this->belongsTo('App\CategoryPost');
    }
    function imageUrl(){
        return 'https://localhost/unimart/'.$this->thumbnail;
    }
}
