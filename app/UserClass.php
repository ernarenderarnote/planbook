<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

use DB; // used for queries like DB::table('table_name')->get();
class UserClass extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_classes';
	
	//public $timestamps = false;


	

    public function user(){


        return $this->belongsTo('App\User');
    }

    public function classSchedule(){


        return $this->hasMany('App\ClassSchedule','class_id');
        //return $this->hasMany(ClassSchedule::class,'class_id');
    }

    public function classLesson(){


        return $this->hasMany('App\ClassLesson','class_id');
        //return $this->hasMany(ClassLesson::class,'class_id');
    }

    public function schoolYear(){

        return $this->belongsTo(SchoolYear::class,'year_id');

    }

    public function scopeGetClasses($q, $start, $end){

        return $q->whereBetween("start_date", [$start, $end])
                 ->orWhere(function ($query) use($start, $end) {
                        $query->whereBetween("end_date", [$start, $end]);
                })
                ->whereYearId(Auth::user()->current_selected_year);
    }
    
    public function assignedStudents(){
        return $this->hasMany('App\ClassAssigned','class_id','id');
    }
   
}
