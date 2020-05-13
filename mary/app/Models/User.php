<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
//    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;

    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded=[];
    protected $table = 'users';

    protected $fillable = [
        'username','fullname','mobile','gender', 'email', 'password','address','guard','about_me'
        ,'partener_info','nationalty_id','resident_country_id','material_status_id','city_id','age'
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

    public function nationalty(){
        return $this->belongsTo(Nationalty::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function material(){
        return $this->belongsTo(Material_status::class);
    }


    public function category(){
        return $this->belongsToMany(Category::class,'user_category');
    }

    public function options(){
        return $this->belongsToMany(Option::class,'user_options');
    }

    public function stories(){
        return $this->hasMany(Story::class);

    }
    public function useractiv()
    {
        return $this->hasMany(User_activity::class);
    }

    public function optionVal(){
        return $this->belongsToMany(Option_value::class,'user_options');
    }

    public function files(){
        return $this->morphMany(File::class,'fileable','fileable_type','fileable_id');
    }

    public function userSetting(){
        return $this->hasMany(User_setting::class);
    }
}
