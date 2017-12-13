<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB; // used for queries like DB::table('table_name')->get();
class Assessment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assessments';
	
	//public $timestamps = false;


	

    public function user(){


        return $this->belongsTo('App\User');
    }

    public function userClass(){


        return $this->belongsTo('App\UserClass','class_id');
    }

    public function unit(){

        return $this->belongsTo('App\Unit','unit_id');
    }

   
    public function avgAssessmentPoints(){

        return $this->hasMany('App\AssessmentPoints','assessment_id','id');
    }
   
}
