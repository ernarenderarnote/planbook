<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyStrategies extends Model
{
   /* The table associated with the model.
     *
     * @var string
     */
    protected $table = 'my_strategies';
	
	//public $timestamps = false;


	

    public function user(){


        return $this->belongsTo('App\User');
    }

}
