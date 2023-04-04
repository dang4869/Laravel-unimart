<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function product()
    {
        return $this->hasMany('App\Product');
    }
    function hasPermission($route)
    {
        $routes = $this->routes();
        return in_array($route, $routes) ? true : false;
    }
    // Các route đã được gán
     function routes(){
        $data = [];
       foreach($this->roles as $role){
        $role_group = json_decode($role->role_group);
        foreach($role_group as $rol){
            if(!in_array($rol,$data)){
                array_push($data, $rol);
            }
        }
       }
        return $data;
    }
    function roles(){
        return $this->belongsToMany('App\Role', 'role_user','user_id','role_id');
    }
}
