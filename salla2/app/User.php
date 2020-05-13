<?php

namespace App;

use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{


    use Notifiable;
    use HasRoles;
    use Favoriteability;

    protected $guard_name = 'web';
    protected $guard = 'web';

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'phone', 'email', 'password', 'guard', 'lastname', 'country_id', 'store_id', 'image', 'gender', 'address'
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

    public function ticket()
    {
        $this->hasMany('App\ticket', 'agent_id', 'id');
    }

    public function membershipUser()
    {
        $this->hasMany('App\membershipUser', 'user_id', 'id');
    }

    public function store()
    {
        $this->hasOne('App\User', 'id', 'store_id');
    }

    public function country()
    {
        $this->hasOne('App\Models\countries', 'id', 'country_id');
    }

    public function ratings()
    {
        return $this->belongsToMany('App\Models\rating\rating', 'user_rating', 'user_id')->withPivot('rating', 'comment', 'store_id');
    }
}
