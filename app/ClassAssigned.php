<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassAssigned extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'class_assigned';
	
	//public $timestamps = false;

	public function student(){

        return $this->belongsTo('App\Students');
    }

    public function assignpoints(){

        return $this->hasMany('App\AssignmentPoints','student_id','student_id');
    }
    public function assesspoints(){

        return $this->hasMany('App\AssessmentPoints','student_id','student_id');
    }
   
}
