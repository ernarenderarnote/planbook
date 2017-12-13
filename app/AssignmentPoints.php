<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentPoints extends Model
{
    protected $table = 'assignment_points';

	public function points(){

	    return $this->hasMany('App\AssignmentPoints','assignment_id');
	}

	public function student(){

	    return $this->belongsTo('App\Students', 'student_id','id');
	}

}

