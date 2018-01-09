<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable,EntrustUserTrait;

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


    public function schoolYear(){

        return $this->hasMany(SchoolYear::class);

    }

    public function userLessonSectionLayout(){

        return $this->hasOne(UserLessonSectionLayout::class);

    }

    public function userClass(){
        return $this->hasMany(UserClass::class);
    }


    public function selectedYear(){
        return $this->belongsTo(SchoolYear::class,'current_selected_year');
    }

    public function viewItems(){
        return $this->belongsTo(ViewItems::class,'id','user_id');
    }


}
