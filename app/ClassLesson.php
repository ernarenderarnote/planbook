<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB; // used for queries like DB::table('table_name')->get();
class ClassLesson extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'class_lessons';
	
	//public $timestamps = false;


	

    //public function class(){
    //    return $this->belongsTo('App\UserClass');
   // }

    
    public function scopeGetLesson($q, $start, $end, $classId = [] ){

       return $q->where("lesson_date","<=", $start)
                ->where("lesson_date",">=", $end)
                ->whereIn('class_id', $classId);
    }
}