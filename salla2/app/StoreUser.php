<?php


namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class StoreUser extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'store';
    protected $guard = 'store';

    protected $table= 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','guard','lastname','phone','store_id','email_verified_at','is_active'
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

    public function ticket(){
        $this->hasMany('App\ticket','agent_id','id');
    }
    public function membershipUser(){
        $this->hasMany('App\membershipUser','user_id','id');
    }

    public function storesData()
    {
        return $this->belongsTo('StoreData', 'id');
    }
}