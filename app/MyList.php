<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyList extends Model
{
   /* The table associated with the model.
     *
     * @var string
     */
    protected $table = 'my_lists';
	
	//public $timestamps = false;


	

    public function user(){


        return $this->belongsTo('App\User');
    }

   
 
}
