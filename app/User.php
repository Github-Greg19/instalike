<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
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
    //UserToPosts Relationship. One to many.
    public function posts()
    {
        #return $this->hasMany(Post::class); #By default, it is accending
        return $this->hasMany(Post::class)->orderBy('created_at','DESC');
    }

    //User to Profile relationship. One is to one.
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
