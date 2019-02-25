<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB; // used for queries like DB::table('table_name')->get();
class Template extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'templates';
	
	//public $timestamps = false;


	

    public function user(){


        return $this->belongsTo('App\User');
    }

    public function userClass(){


        return $this->belongsTo('App\UserClass','class_id');
    }

    
}
