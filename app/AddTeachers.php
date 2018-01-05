<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddTeachers extends Model
{
    protected $table = 'add_teachers';

    public function usermeta(){
    	return $this->belongsTo('App\User','teacher_id','id');
    }
}
