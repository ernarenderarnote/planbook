<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Students extends Authenticatable
{

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

    public function teacher(){
        return $this->belongsTo(ClassAssigned::class);
    }

    public function assignClass(){

        return $this->hasMany(ClassAssigned::class);

    }
     public function selectedYear(){
        return $this->belongsTo(SchoolYear::class,'teacher_id','user_id');
    }
    public function assignments(){
    return $this->hasMany('App\Assignment','student_id');
   }
}
