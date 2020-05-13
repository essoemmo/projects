<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web';
    protected $guard = 'web';
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'membership_number',
        'first_name',
        'last_name',
        'email',
        'image',
        'guard',
        'user_type',
        'job_type',
        'identify_number',
        'identify_image',
        'mobile',
        'country_id',
        'city_id',
        'gender',
        'status',
        'send_email',
        'send_sms',
        'provider_id',
        'provider',
        'password',
        'cost',
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

    public function verifyUser()
    {
        return $this->hasOne('App\Models\VerifyUser');
    }

    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }

    public function UserSocial()
    {
        return $this->belongsToMany('App\Models\Social_link', 'social_link_user', 'user_id', 'social_id');
    }

    public function user_social()
    {
        return $this->hasMany('App\Models\SocialLinkUser', 'user_id', 'id');
    }

}
