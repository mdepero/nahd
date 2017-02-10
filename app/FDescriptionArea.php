<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FDescriptionArea extends Model
{
    
    public function options(){

    	return $this->hasMany('App\FDescriptionOption');
    }

    public function section(){

    	return $this->belongsTo('App\FSection');
    }

    public function descriptions(){

    	return $this->hasMany('App\Description');
    }
}
