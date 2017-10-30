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

   
}
