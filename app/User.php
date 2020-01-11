<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Profile;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;

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

    public function isAdmin() {
      return $this->role === 'admin';
    }

    public function getGravatar() {
      $hash = md5(strtolower(trim($this->attributes['email'])));
      return "http://gravatar.com/avatar/$hash";
    }

    public function hasPicture() {
      if (preg_match('/profilesPicture/',$this->profile->picture,$match)) {
        return true;
      } else {
        return false;
      }
    }

    public function getPicture() {
      return $this->profile->picture;
    }

    public function profile() {
      return $this->hasOne(Profile::class);
    }

    public function posts() {
      return $this->hasMany(Post::class);
    }


}
