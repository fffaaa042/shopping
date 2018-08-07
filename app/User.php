<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //User has one Role
    public function Role(){
        return $this->belongsTo('App\Role');
    }

    public function Photo(){
       return $this->belongsTo('App\Photo');
    }

    //important
    public function posts(){
        return $this->hasMany('App\Post');
    }

    //Method For the Admin Middleware
    public function isAdmin(){
        if($this->role->name == "administrator" && $this->is_active == 1){
            return true;
        }
        return false;
    }







}
