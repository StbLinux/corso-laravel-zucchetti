<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasApiTokens;
    use \Spiritix\LadaCache\Database\LadaCacheTrait;

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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // ha 1+ Post // posts() // hasMany
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // ha 1+ Comment // comments() // hasMany
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
