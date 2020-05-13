<?php

namespace App;

use App\Hr\Course\Exam;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use App\Hr\Course\Course;

use Illuminate\Contracts\Auth\MustVerifyEmail;
class User extends Authenticatable implements MustVerifyEmail
{
    use Favoriteability;
    use Notifiable;
    use HasRoles;
    use HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'is_active', 'email', 'password','country_id','type','mobile','is_admin' ,'image'
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

    public function ratings(){
        return $this->belongsToMany('App\Models\rating\rating','user_rating','user_id','rating_id')->withPivot('rating','comment');
    }

    public function cources(){
        return $this->hasMany(Course::class);
    }
//    public function getFirstName()
//    {
//        return 'asdasdas';
//    }

    public function exams(){
        $this->belongsToMany(Exam::class, 'user_exams');
    }
}
