<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FConcernArea extends Model
{
    
    public function options(){

    	return $this->hasMany('App\FConcernOption');
    }

    public function section(){

    	return $this->belongsTo('App\FSection');
    }

    public function concerns(){

    	return $this->hasMany('App\Concern');
    }
}
