<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use DB;

class ContactUsMesssge extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contactuses';
     protected $fillable = [
        'user_id', 'message','image','screenshot',
    ];
    
    public function user(){    
    	return $this->belongsTo('App\User', 'id');
    }
}
