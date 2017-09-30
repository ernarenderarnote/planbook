<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';
	public $fillable = ['start_date','end_date','starttime','endtime','repeats','schoolday','title','description'];
	//public $timestamps = false;


	

    public function user(){

        return $this->belongsTo('App\User');
    }

   
}
