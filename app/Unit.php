<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB; // used for queries like DB::table('table_name')->get();
class Unit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'units';
	
	//public $timestamps = false;


	

    public function user(){


        return $this->belongsTo('App\User');
    }

    public function userClass(){


        return $this->belongsTo('App\UserClass','class_id');
    }

    public function lessons(){


        return $this->hasMany('App\ClassLesson','unit');
    }
    

   
}
