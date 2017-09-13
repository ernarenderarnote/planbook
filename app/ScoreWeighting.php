<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreWeighting extends Model
{
     protected $table = 'score_weightings';

public function user(){


        return $this->belongsTo('App\User');
    }

    public function userClass(){


        return $this->belongsTo('App\UserClass','class_id');
    }

    public function unit(){

        return $this->belongsTo('App\Unit','unit_id');
    }
}